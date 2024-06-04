<?php

namespace Orangesix\Service;

trait ServiceAutoInstance
{
    /**
     * @param string $class
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function instanceAutoService(string $class, ?string $path = null): mixed
    {
        $service = str_replace('service', '', $class) . 'Service';
        $instance = getClass(empty($path) ? app_path('Service') : $path, $service);
        if (!empty($instance)) {
            $class = $instance['namespace'] . '\\' . $instance['class'];
            return app()->make($class);
        }
        return null;
    }
}
