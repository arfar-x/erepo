<?php

namespace Erepo\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
        $this->prepare();
    }

    /**
     * Initialize and boot necessary conditions.
     *
     * @return void
     */
    protected function prepare()
    {
        $this->initTraits();
        $this->boot();
    }

    /**
     * Run traits' `init` methods to prepare the environment.
     * Convention: init + [trait_name]()
     * E.g. trait Encoder => initEncoder()
     *
     * @return void
     */
    protected function initTraits()
    {
        foreach (class_uses_recursive(static::class) as $trait) {
            $method = 'init'.class_basename($trait);

            if (method_exists($trait, $method)) {
                call_user_func([$this, $method]);
            }
        }
    }

    /**
     * Boot anything needed for the repository.
     *
     * @return void
     */
    protected function boot()
    {
        //
    }

    /**
     * Run the callable with given temporary model.
     *
     * @param Model $model
     * @param callable|string $callable
     * @param array ...$args
     * @return mixed
     */
    public function runWith(Model $model, callable|string $callable, ...$args)
    {
        /**
         * Here we store current model instance in a temporary variable to be untouched,
         * and our secondary given model is used for callable, then previous model
         * will be replaced.
         */
        $currentModel = $this->model;
        $this->model = $model;
        
        if (is_string($callable)) {
            $result = call_user_func([$this, $callable], $model, $args);
        }
        
        elseif (is_callable($callable)) {
            array_unshift($args, $model);
            $result = tap($callable, $args);
        }

        $this->model = $currentModel;

        return $result;
    }

    /**
     * @param Model $model
     * @return static
     */
    public function setModel(Model $model): static
    {
        $this->model = $model;

        return $this;
    }
}
