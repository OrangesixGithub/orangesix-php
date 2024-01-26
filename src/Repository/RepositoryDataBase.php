<?php

namespace Orangecode\Repository;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Orangecode\Model\ModelAutoInstance;

trait RepositoryDataBase
{
    use ModelAutoInstance;

    /**
     * @param string $name
     * @return mixed
     * @throws BindingResolutionException
     */
    public function __get(string $name)
    {
        return $this->instanceAutoModel($name);
    }

    /**
     * @return Model
     */
    public function getModel(): Model
    {
        return $this->model;
    }

    /**
     * @param array $data
     * @return int
     */
    public function save(array $data): int
    {
        $model = empty($data['id'])
            ? $this->model
            : $this->model::findOrFail($data['id']);
        foreach ($data as $key => $value) {
            $model->$key = $value;
        }
        $model->save();
        return $model->id;
    }

    /**
     * @param int $id
     * @return void
     */
    public function remove(int $id): void
    {
        $data = $this->model::findOrFail($id);
        $data->delete();
    }

    /**
     * @param int|null $id
     * @return Collection|Model|null
     */
    public function find(int $id): Model|null
    {
        return $this->model::findOrFail($id);
    }

    /**
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model::all();
    }
}
