<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\ModelNotFoundException;

abstract class EloquentRepository implements CrudContract
{
    abstract protected function getModel() : string;

    public function create($data)
    {
        $model = $this->getModel();

        $model = new $model;

        $model->fill($data);

        return $this->saveOrFail($model);
    }

    public function all($query, $filters, $sort = null, $page = null)
    {
        return $this->getModel()::all();
    }

    public function find($id)
    {
        return $this->findOrFail($id)->toArray();
    }

    public function findOrFail($id)
    {
        $model = $this->getModel()::find($id);

        if (!$model) {
            throw new ModelNotFoundException("Resource Not Found");
        }

        return $model;
    }

    public function update($id, $data)
    {
        $model = $this->findOrFail($id);

        $model->fill($data);

        return $this->saveOrFail($model);
    }

    public function delete($id)
    {
        $model = $this->findOrFail($id);

        return $model->delete();
    }

    protected function saveOrFail($model)
    {
        if ($model->save()){
            return $model->toArray();
        }
        throw new \Exception("Model couldnt be save", 500);
    }
}