<?php

namespace App\Infrastructure\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface BaseRepositoryInterface
{
	/**
	 * Return repository entity model used
	 *
	 * @return string
	 */
	public function model(): string;

	/**
	 * Initialize new Eloquent model
	 *
	 * @return Model
	 */
    public function initialize(): Model;

    /**
     * Build and return builded query from request context
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
	public function getAll(Request $request): LengthAwarePaginator;

    /**
     * Create, persist and return new Eloquent Model
     *
     * @param array $attributes
     * @return Model
     */
	public function create(array $attributes): Model;

	/**
	 * Update Eloquent model from his identifier
	 *
	 * @param array $attributes
	 * @param int $id
	 * @return Model
	 */
	public function update(array $attributes, int $id): Model;

	/**
	 * Destroy the models for the given IDs.
	 *
	 * @param int $id
	 * @return int
	 */
	public function destroy(int $id): int;

	/**
	 * Find Eloquent Model from his identifier based on field list
	 *
	 * @param string $id
	 * @param array|object $columns
	 * @return Model
	 */
	public function find(string $id, $columns = array('*')): Model;

	/**
	 * Add relational to request
	 *
	 * @param array $withRelation
	 * @return void
	 */
	public function setWithRelation(array $withRelation = []): void;

}