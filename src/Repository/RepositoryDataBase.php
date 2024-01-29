<?php

namespace Orangecode\Repository;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\Model;
use Orangecode\Models\ModelAutoInstance;
use Orangecode\Service\ServiceAutoInstance;

trait RepositoryDataBase
{
    use RepositoryTransferList;
    use ModelAutoInstance;
    use ServiceAutoInstance;

    /** @var array  */
    private ?array $autoInstance;

    /**
     * @param string $name
     * @return mixed
     * @throws BindingResolutionException
     */
    public function __get(string $name)
    {
        if (strpos($name, 'service') !== false) {
            return $this->instanceAutoService($name, $this->autoInstance['service'] ?? null);
        }
        return $this->instanceAutoModel($name, $this->autoInstance['model'] ?? null);
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
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed
    {
        return $this->model::findOrFail($id);
    }
}
