<?php

namespace App\Infrastructure\Contracts;

use Illuminate\Http\Request;
use App\Application\Exceptions\RepositoryException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Container\Container as App;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected int $perPage = 10;

    /**
     * @var App $app
     */
    private $app;

    /**
     * @var Model $model
     */
    protected $model;

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
	 * Build and return builded query from request context
	 * 
	 * @return \Illuminate\\Pagination\\LengthAwarePaginator
	 */
    public function getAll(Request $request): LengthAwarePaginator
    {
        $query = $this->model->query();

        if (is_null($request->fields)) {
            $query->with($this->with);
        }

        $query = $this->handleFieldsParameters($query, $request);
        $query = $this->handleOrderByParameters($query, $request);
        $query = $this->handleSearchParameters($query, $request);
        $query = $this->handlePaginationParameters($query, $request);

        return $query;
    }

    /**
	 * Create, persist and return new Eloquent Model
	 * 
	 * @return \Illuminate\Database\Eloquent\Model
	 */
    public function create(array $attributes): Model
    {
        $object = $this->model->create($attributes);

        return $object->load($this->with);
    }

    /**
     * Update Eloquent model from his identifier
     *
     * @param array $attributes
     * @param int $id
     * @return \Illuminate\Database\Eloquent\Model
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
     * Destroy the models for the given IDs.
     *
     * @param int $id
     * @return int
     */
	public function destroy(int $id): int
    {
        return $this->model->destroy($id);
    }

    /**
     * Find Eloquent Model from his identifier based on field list
     *
     * @param string $id
     * @param array|object $columns
     * @return Model
     */
	public function find(string $id, $columns = array('*')): Model
    {
        return $this->model->with($this->with)->findOrFail($id);
    }

    /**
     * Add relationnal to request
     *
     * @param array $withRelation
     * @return void
     */
	public function setWithRelation(array $withRelation = []): void
    {
        $this->with = $withRelation;
    }
    
    private function makeModel()
    {
        $model = $this->app->make($this->model());

        if (!$model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    // CRITERIA

    /**
     * Handle "limit" on Query object depending on Request datas.
     *
     * @param Request      $request
     * @param QueryBuilder $query
     *
     * @return QueryBuilder
     */
    protected function handlePaginationParameters(QueryBuilder $query, Request $request)
    {
        if ($request->limit === 'full') {
            $model         = static::MODEL;
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
    protected function handleFieldsParameters(QueryBuilder $query, Request $request)
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
    protected function handleOrderByParameters(QueryBuilder $query, Request $request)
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
    protected function handleSearchParameters(QueryBuilder $query, Request $request)
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
     * @param string       $fieldName
     * @param string       $searchType
     * @param mixed        $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchQuery(QueryBuilder $query, $fieldName, $searchType, $values)
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
    }

    /**
     * Choose search constraint based on search type.
     *
     * @param QueryBuilder $query
     * @param string       $fieldName
     * @param string       $searchType
     * @param mixed        $values

     * @return QueryBuilder
     */
    protected function handleSearchType(QueryBuilder $query, $fieldName, $searchType, $values)
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
    protected function handleSearchEqual(QueryBuilder $query, $fieldName, $value)
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
    protected function handleSearchLike(QueryBuilder $query, $fieldName, $values)
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
    protected function handleSearchOrLike(QueryBuilder $query, $fieldName, $values)
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
     * @param string       $fieldName
     * @param array        $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchBetween(QueryBuilder $query, $fieldName, $values)
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
     * @param string       $fieldName
     * @param array        $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchBetweenDates(QueryBuilder $query, $fieldName, $values)
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
