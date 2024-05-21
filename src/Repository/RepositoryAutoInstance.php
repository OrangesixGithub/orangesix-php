<?php

namespace Orangesix\Repository;

trait RepositoryAutoInstance
{
    /**
     * @param string $class
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function instanceAutoRepository(string $class, ?string $path = null): mixed
    {
        $repository = str_replace('repository', '', $class) . 'Repository';
        $instance = getClass(empty($path) ? app_path('Repository') : $path, $repository);
        if (!empty($instance)) {
            $class = $instance['namespace'] . DIRECTORY_SEPARATOR . $instance['class'];
            return app()->make($class);
        }
        return null;
    }
}
