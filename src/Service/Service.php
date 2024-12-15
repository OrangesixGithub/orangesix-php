<?php

namespace Orangesix\Service;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

interface Service
{
    /**
     * @return Model
     */
    public function getModel(): Model;

    /**
     * @param int $id
     * @return mixed
     */
    public function find(int $id): mixed;

    /**
     * @param Request $request
     * @return mixed
     */
    public function manager(Request $request): mixed;

    /**
     * @param Request $request
     * @return void
     */
    public function delete(Request $request): void;

    /**
     * @param Request $request
     * @return array
     */
    public function validated(Request $request): array;

    /**
     * @param array $validation
     * @param array $data
     * @return self
     */
    public function setValidated(array $validation, array $data = []): self;
}
