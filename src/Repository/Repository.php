<?php

namespace Orangesix\Repository;

use Illuminate\Database\Eloquent\Model;

interface Repository
{
    /**
     * @return Model
     */
    public function getModel(): Model;

    /**
     * @param Model $model
     * @return void
     */
    public function setModel(Model $model): void;

    /**
     * @param array $data
     * @return int
     */
    public function save(array $data): int;

    /**
     * @param int $id
     * @return void
     */
    public function remove(int $id): void;

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * @param string $name
     * @param callable $callback
     * @return void
     */
    public function registerFilter(string $name, callable $callback): void;

    /**
     * @param array $field
     * @return void
     */
    public function setField(array $field): void;
}
