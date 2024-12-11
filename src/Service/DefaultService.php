<?php

namespace Orangesix\Service;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use Orangesix\Repository\DefaultRepository;

/**
 * Service - DEFAULT
 *
 * @method findAll(?Request $request = null, string $exec = 'paginate' | 'get')
 */
class DefaultService extends ServiceBase
{
    public function __construct(DefaultRepository $repository)
    {
        parent::__construct($repository);
    }

    /**
     * @param string $model
     * @return $this
     * @throws BindingResolutionException
     */
    public function setModel(string $model): DefaultService
    {
        $this->repository->setModel(app()->make($model));

        return $this;
    }

    /**
     * @param array $fields
     * @return self
     */
    public function setField(array $fields): DefaultService
    {
        $this->repository->setField($fields);

        return $this;
    }

    /**
     * @param string $name
     * @param callable $callback
     * @return DefaultService
     */
    public function registerFilter(string $name, callable $callback): DefaultService
    {
        $this->repository->registerFilter($name, $callback);

        return $this;
    }
}
