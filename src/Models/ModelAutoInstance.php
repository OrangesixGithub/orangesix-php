<?php

namespace Orangecode\Models;

trait ModelAutoInstance
{
    /**
     * @param string $class
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function instanceAutoModel(string $class): mixed
    {
        $model = str_replace('model', '', $class) . 'Model';
        $instance = getClass(app_path('Models'), $model);
        if (!empty($instance)) {
            $class = $instance['namespace'] . DIRECTORY_SEPARATOR . $instance['class'];
            return app()->make($class);
        }
        return null;
    }
}
