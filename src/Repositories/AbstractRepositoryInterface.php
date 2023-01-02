<?php

namespace Erepo\Repositories;

use Illuminate\Database\Eloquent\Model;

interface BaseRepositoryInterface
{
    /**
     * Run the callable with given temporary model.
     *
     * @param Model $model
     * @param callable|string $callable
     * @param array ...$args
     * @return mixed
     */
    public function runWith(Model $model, callable|string $callable, ...$args);

    /**
     * @param Model $model
     * @return static
     */
    public function setModel(Model $model): static;
}
