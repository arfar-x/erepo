<?php

namespace Erepo\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface BaseRepositoryInterface
{
    /**
     * @param array $queries
     * @return LengthAwarePaginator|Collection
     */
    public function list(array $queries = []): LengthAwarePaginator|Collection;

    /**
     * @param array $parameters
     * @return Model
     */
    public function create(array $parameters): Model;

    /**
     * @param Model $model
     * @return Model
     */
    public function show(Model $model): Model;

    /**
     * @param Model $model
     * @param array $parameters
     * @return Model
     */
    public function update(Model $model, array $parameters): Model;

    /**
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool;

    /**
     * Find an exact record by given key-value.
     *
     * @param string $key
     * @param string $value
     * @return Model|null
     */
    public function findBy(string $key, string $value): Model|null;

    /**
     * Find record within the given range.
     *
     * @param string $key
     * @param string|array|null $values
     * @return Model
     */
    public function findIn(string $key, string|array $values = null): Builder|null;

    /**
     * Activate the model record.
     *
     * @param Model $model
     * @return Model
     */
    public function activate(Model $model): Model;

    /**
     * Deactivate the model record.
     *
     * @param Model $model
     * @return Model
     */
    public function deactivate(Model $model): Model;
}
