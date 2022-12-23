<?php

namespace Erepo\Concerns;

use Illuminate\Database\Eloquent\Model;

trait Activatable
{
    /**
     * Activate the model record.
     *
     * @param Model $model
     * @return Model
     */
    public function activate(Model $model): Model
    {
        return $this->update($model, ['status' => true]);
    }

    /**
     * Deactivate the model record.
     *
     * @param Model $model
     * @return Model
     */
    public function deactivate(Model $model): Model
    {
        return $this->update($model, ['status' => false]);
    }
}
