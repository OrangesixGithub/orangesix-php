<?php

namespace Orangecode\Controller;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Routing\Controller;
use Orangecode\Service\Response\ServiceResponse;
use Orangecode\Service\ServiceBase;

abstract class ControllerBase extends Controller
{
    use Service;

    protected ServiceResponse $response;

    protected ServiceBase|string|null $service;

    public function __construct(ServiceBase $service = null)
    {
        $this->response = app()->make(ServiceResponse::class);
        $this->service = empty($service) || !is_string($service)
            ? app()->make(ServiceBase::class)
            : app()->make($service);
    }

    /**
     * @throws BindingResolutionException
     */
    public function __get(string $name)
    {
        return $this->instanceAutoService($name);
    }
}
