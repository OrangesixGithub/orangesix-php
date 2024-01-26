<?php

namespace Orangecode\Service;

trait ServiceAutoInstance
{
    /**
     * @param string $class
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function instanceAutoService(string $class): mixed
    {
        $service = str_replace('service', '', $class) . 'Service';
        $instance = getClass(app_path('Service'), $service);
        if (!empty($instance)) {
            $class = $instance['namespace'] . DIRECTORY_SEPARATOR . $instance['class'];
            return app()->make($class);
        }
        return null;
    }
}
