<?php

namespace Orangecode\Controller;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Routing\Controller;
use Orangecode\Service\Response\ServiceResponse;

abstract class ControllerBase extends Controller
{
    use Service;

    protected ServiceResponse $response;

    public function __construct()
    {
        $this->response = app()->make(ServiceResponse::class);
    }

    /**
     * @throws BindingResolutionException
     */
    public function __get(string $name)
    {
        return $this->instanceAutoService($name);
    }
}
