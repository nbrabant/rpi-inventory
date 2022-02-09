<?php

namespace App\Infrastructure\Contracts;

use App\Infrastructure\Entities\Dto;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use App\Application\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var int $perPage
     */
    protected int $perPage = 10;

    /**
     * @var App $app
     */
    private App $app;

    /**
     * @var Model $model
     */
    protected Model $model;

    /**
     * @var array $with
     */
    protected array $with = [];

    public function __construct(App $app)
    {
        $this->app = $app;
        $this->makeModel();
    }

    /**
     * @inheritDoc
     */
    public function getAll(Request $request): LengthAwarePaginator
    {
        $query = $this->model->query();

        if (is_null($request->fields)) {
            $query->with($this->with);
        }

        // @TODO : move to search criteria
        $query = $this->handleFieldsParameters($query, $request);
        $query = $this->handleOrderByParameters($query, $request);
        $query = $this->handleSearchParameters($query, $request);
        $query = $this->handlePaginationParameters($query, $request);

        return $query;
    }

    /**
     * @inheritDoc
     */
    public function save(Dto $recipeData, ?int $id = null): Model
    {
        if (!is_null($id)) {
            return $this->update((array)$recipeData, $id);
        }

        return $this->create((array)$recipeData);
    }

    /**
     * @inheritDoc
     */
    public function create(array $attributes): Model
    {
        $object = $this->model->create($attributes);

        return $object->load($this->with);
    }

    /**
     * @inheritDoc
     */
    public function update(array $attributes, int $id): Model
    {
        if (array_key_exists('id', $attributes)) {
            unset($attributes['id']);
        }

        $object = $this->model->findOrFail($id);
        $object->fill($attributes)->save();

        $object->load($this->with);

        return $object;
    }

    /**
     * @inheritDoc
     */
	public function destroy(int $id): int
    {
        return $this->model->destroy($id);
    }

    /**
     * @inheritDoc
     */
	public function find(string $id, $columns = array('*')): Model
    {
        return $this->model->with($this->with)->findOrFail($id);
    }

    /**
     * @inheritDoc
     */
	public function setWithRelation(array $withRelation = []): void
    {
        $this->with = $withRelation;
    }

    /**
     * @throws RepositoryException
     * @throws BindingResolutionException
     */
    private function makeModel(): void
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        $this->model = $model;
    }

    // CRITERIA - move to specific builder class

    /**
     * Handle "limit" on Query object depending on Request datas.
     *
     * @param Request      $request
     * @param QueryBuilder $query
     *
     * @return LengthAwarePaginator
     */
    protected function handlePaginationParameters(QueryBuilder $query, Request $request): LengthAwarePaginator
    {
        if ($request->limit === 'full') {
            $model         = static::MODEL; // @TODO : test this...
            $this->perPage = $model::count();
        } elseif (ctype_digit($request->limit) && $request->limit) {
            $this->perPage = (int) $request->limit;
        }

        return $query->paginate($this->perPage);
    }

    /**
     * Add "select" on Query object depending on Request datas.
     *
     * @param Request      $request
     * @param QueryBuilder $query
     *
     * @return QueryBuilder
     */
    protected function handleFieldsParameters(QueryBuilder $query, Request $request): QueryBuilder
    {
        if (! $request->fields) {
            return $query;
        }

        $fields = $request->fields;
        if (! is_array($request->fields)) {
            $fields = explode(',', $fields);
        }

        return $query->select($fields);
    }

    /**
     * Add "order by" on Query object depending on Request datas.
     *
     * @param Request      $request
     * @param QueryBuilder $query
     *
     * @return QueryBuilder
     */
    protected function handleOrderByParameters(QueryBuilder $query, Request $request): QueryBuilder
    {
        if (! $request->sortCol || ! $request->sortDir) {
            return $query;
        }

        $dotPos = strpos($request->sortCol, '.');
        if ($dotPos === false || $dotPos <= 0) {
            return $query->orderBy($request->sortCol, $request->sortDir);
        }

        foreach ($this->with as $relation) {
            if (substr_compare($request->sortCol, snake_case($relation), 0, $dotPos) === 0) {
                $method = 'orderBy'.ucfirst($relation);

                return $query->$method(substr($request->sortCol, $dotPos + 1), $request->sortDir);
            }
        }

        return $query->orderBy($request->sortCol, $request->sortDir);
    }

    /**
     * Add search constraints (where) on Query object depending on Request datas.
     *
     * @param QueryBuilder $query
     * @param Request      $request
     *
     * @return QueryBuilder
     */
    protected function handleSearchParameters(QueryBuilder $query, Request $request): QueryBuilder
    {
        if (!$request->search || (!is_array($request->search) && !is_string($request->search))) {
            return $query;
        }

        // @TODO : refactoring
        if (is_array($request->search)) {
            foreach ($request->search as $fieldName => $search) {
                foreach ($search as $searchType => $values) {
                    $this->handleSearchQuery($query, $fieldName, $searchType, $values);
                }
            }
        } elseif (is_string($request->search)) {
            $requestSearch = json_decode($request->search);

            if (!$requestSearch || empty($requestSearch)) {
                return $query;
            }

            foreach ($requestSearch as $fieldName => $search) {
                foreach ($search as $searchType => $values) {
                    $this->handleSearchQuery($query, $fieldName, $searchType, $values);
                }
            }
        }

        return $query;
    }

    /**
     * Build search query for the given field name, type and values.
     *
     * @param QueryBuilder $query
     * @param string $fieldName
     * @param string $searchType
     * @param mixed        $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchQuery(QueryBuilder $query, string $fieldName, string $searchType, $values): QueryBuilder
    {
        $dotPos = strpos($fieldName, '.');
        if ($dotPos === false || $dotPos <= 0) {
            return $this->handleSearchType($query, $fieldName, $searchType, $values);
        }

        if (substr_compare($fieldName, 'scope', 0, $dotPos) === 0 && $values !== '' && $searchType !== 'options') {
            $scope = substr($fieldName, $dotPos + 1);

            return $query->$scope($values);
        }

        if (empty($values)) {
            return $query;
        }

        foreach ($this->with as $relation) {
            if (substr_compare($fieldName, snake_case($relation), 0, $dotPos) === 0) {
                $fieldName = substr($fieldName, $dotPos + 1);

                return $query->whereHas($relation, function ($query) use ($fieldName, $searchType, $values) {
                    return $this->handleSearchType($query, $fieldName, $searchType, $values);
                });
            }
        }

        return $query;
    }

    /**
     * Choose search constraint based on search type.
     *
     * @param QueryBuilder $query
     * @param string $fieldName
     * @param string $searchType
     * @param mixed        $values
     * @return QueryBuilder
     */
    protected function handleSearchType(QueryBuilder $query, string $fieldName, string $searchType, $values): QueryBuilder
    {
        if ($searchType === 'equal' && is_string($values) && mb_strlen($values)) {
            return $this->handleSearchEqual($query, $fieldName, $values);
        }

        if ($searchType === 'numeric' && is_string($values) && mb_strlen($values)) {
            $values = str_replace(",", ".", $values);
            return $this->handleSearchLike($query, $fieldName, $values);
        }

        if ($searchType === 'bool' && is_numeric($values)) {
            return $this->handleSearchEqual($query, $fieldName, $values);
        }

        if ($searchType === 'like' && is_string($values) && mb_strlen($values)) {
            return $this->handleSearchLike($query, $fieldName, $values);
        }

        if ($searchType === 'or_like' && is_string($values) && mb_strlen($values)) {
            return $this->handleSearchOrLike($query, $fieldName, $values);
        }

        if ($searchType === 'between' && is_array($values)) {
            return $this->handleSearchBetween($query, $fieldName, $values);
        }

        if ($searchType === 'between-dates' && is_array($values)) {
            return $this->handleSearchBetweenDates($query, $fieldName, $values);
        }

        return $query;
    }

    /**
     * Add exact constraint on query for the given field name and value.
     *
     * @param QueryBuilder $query
     * @param string $fieldName
     * @param string $value
     *
     * @return QueryBuilder
     */
    protected function handleSearchEqual(QueryBuilder $query, string $fieldName, string $value): QueryBuilder
    {
        return $query->where($fieldName, $value);
    }

    /**
     * Add approximate constraint on query for the given field name and values.
     *
     * @param QueryBuilder $query
     * @param string $fieldName
     * @param string $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchLike(QueryBuilder $query, string $fieldName, string $values): QueryBuilder
    {
        foreach (explode(' ', $values) as $value) {
            $query->where($fieldName, 'like', '%'.$value.'%');
        }

        return $query;
    }

    /**
     * Add approximate constraint on query for the given field name and values.
     *
     * @param QueryBuilder $query
     * @param string $fieldName
     * @param string $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchOrLike(QueryBuilder $query, string $fieldName, string $values): QueryBuilder
    {
        foreach (explode(' ', $values) as $value) {
            $query->orWhere($fieldName, 'like', '%'.$value.'%');
        }

        return $query;
    }

    /**
     * Add interval constraint on query for the given field name and values.
     *
     * @param QueryBuilder $query
     * @param string $fieldName
     * @param array $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchBetween(QueryBuilder $query, string $fieldName, array $values): QueryBuilder
    {
        if (array_key_exists('min', $values) && mb_strlen($values['min'])) {
            $query->where($fieldName, '>=', $values['min']);
        }

        if (array_key_exists('max', $values) && mb_strlen($values['max'])) {
            $query->where($fieldName, '<=', $values['max']);
        }

        return $query;
    }

    /**
     * Add date interval constraint on query for the given field name and values.
     *
     * @param QueryBuilder $query
     * @param string $fieldName
     * @param array $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchBetweenDates(QueryBuilder $query, string $fieldName, array $values): QueryBuilder
    {
        if (array_key_exists('min', $values) && mb_strlen($values['min'])) {
            $query->where(DB::raw('DATE('.$fieldName.')'), '>=', $values['min']);
        }

        if (array_key_exists('max', $values) && mb_strlen($values['max'])) {
            $query->where(DB::raw('DATE('.$fieldName.')'), '<=', $values['max']);
        }

        return $query;
    }
}
