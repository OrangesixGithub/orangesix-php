<?php

namespace Orangecode\Helpers\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface Service
{
    /**
     * @param int|null $id
     * @return Collection|Model|null
     */
    public function find(int $id = null): Collection | Model | null;

    /**
     * @param Request $request
     * @return mixed
     */
    public function manager(Request $request): mixed;

    /**
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request): void;

    /**
     * @param Request $request
     * @return array
     */
    public function validated(Request $request): array;

    /**
     * @return Model
     */
    public function getModel(): Model;
}
