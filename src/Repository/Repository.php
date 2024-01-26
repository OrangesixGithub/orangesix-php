<?php

namespace Orangecode\Helpers\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface Repository
{
    /**
     * @return Model
     */
    public function getModel(): Model;

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
     * @param int|null $id
     * @return Collection|Model|null
     */
    public function find(int $id = null): Collection | Model | null;
}
