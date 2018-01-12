<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Http\Request;

abstract class RestController extends Controller
{
    const MODEL = null;

    protected $perPage = 10;
    protected $with    = [];

    protected $validation = [];
    protected $messages   = [];
    protected $attributes = [];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = static::MODEL;

        $query = $model::query();

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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = static::MODEL;

        return new $model();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = static::MODEL;

        $this->validate($request, $this->validation, $this->messages, $this->attributes);

        $attributes =  $request->only(array_keys($this->validation));

        $object = $model::create($attributes);
        $object->load($this->with);

        return $object;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = static::MODEL;

        return $model::with($this->with)->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = static::MODEL;

        $this->validate($request, $this->validation, $this->messages, $this->attributes);

        $attributes =  $request->only(array_keys($this->validation));
        if (array_key_exists('id', $attributes)) {
            unset($attributes['id']);
        }

        $object = $model::findOrFail($id);
        $object->fill($attributes)->save();

        $object->load($this->with);

        return $object;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = static::MODEL;

        $model::findOrFail($id)->delete();

        return [];
    }

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
        } elseif (ctype_digit($request->limit)) {
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
        if (!$request->search || !is_array($request->search)) {
            return $query;
        }

        foreach ($request->search as $fieldName => $search) {
            foreach ($search as $searchType => $values) {
                $this->handleSearchQuery($query, $fieldName, $searchType, $values);
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
     * @param string       $fieldName
     * @param string       $value
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
     * @param string       $fieldName
     * @param string       $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchLike(QueryBuilder $query, $fieldName, $values)
    {
        foreach (explode(' ', $values) as $value) {
            $query->where($fieldName, 'like', '%'.$value.'%');
        }
    }

    /**
     * Add approximate constraint on query for the given field name and values.
     *
     * @param QueryBuilder $query
     * @param string       $fieldName
     * @param string       $values
     *
     * @return QueryBuilder
     */
    protected function handleSearchOrLike(QueryBuilder $query, $fieldName, $values)
    {
        foreach (explode(' ', $values) as $value) {
            $query->orWhere($fieldName, 'like', '%'.$value.'%');
        }
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
