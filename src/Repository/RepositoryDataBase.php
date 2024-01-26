<?php

namespace Orangecode\Helpers\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait RepositoryDataBase
{
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
        $model = empty($data["id"])
            ? $this->model
            : $this->model::findOrFail($data["id"]);
        foreach ($data as $key => $value)
            $model->$key = $value;
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
    public function find(int $id = null): Collection|Model|null
    {
        if (!empty($id))
            return $this->model::findOrFail($id);
        return $this->model::all();
    }
}
