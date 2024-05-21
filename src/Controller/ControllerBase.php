<?php

namespace Orangesix\Controller;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Routing\Controller;
use Orangesix\Service\ServiceAutoInstance;
use Orangesix\Service\Response\ServiceResponse;

abstract class ControllerBase extends Controller
{
    use ServiceAutoInstance;

    protected ServiceResponse $response;

    /** @var array  */
    private ?array $autoInstance;

    /**
     * @throws BindingResolutionException
     */
    public function __construct(?array $autoInstance = null)
    {
        $this->response = app()->make(ServiceResponse::class);
        $this->autoInstance = $autoInstance;
    }

    /**
     * @param string $name
     * @return mixed
     * @throws BindingResolutionException
     */
    public function __get(string $name)
    {
        return $this->instanceAutoService($name, $this->autoInstance['service'] ?? null);
    }
}
