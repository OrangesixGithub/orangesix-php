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
        $paths = [
            app_path('Service'),
            app_path('Services'),
        ];
        foreach ($paths as $servicePath) {
            $instance = getClass(empty($path) ? $servicePath : $path, $service);
            if (!empty($instance)) {
                break;
            }
        }

        if (!empty($instance)) {
            $class = $instance['namespace'] . '\\' . $instance['class'];
            return app()->make($class);
        } else {
            $classDefault = 'Orangesix\\Service\\DefaultService';
            return app()->make($classDefault);
        }
    }
}
