<?php

namespace Orangecode\Repository;

trait RepositoryAutoInstance
{
    /**
     * @param string $class
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function instanceAutoRepository(string $class): mixed
    {
        $repository = str_replace('repository', '', $class) . 'Repository';
        $instance = getClass(app_path('Repository'), $repository);
        if (!empty($instance)) {
            $class = $instance['namespace'] . DIRECTORY_SEPARATOR . $instance['class'];
            return app()->make($class);
        }
        return null;
    }
}
