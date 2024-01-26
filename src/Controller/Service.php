<?php

namespace Orangecode\Controller;

trait Service
{
    /**
     * @param string $class
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    private function instanceAutoService(string $class): mixed
    {
        $service = str_replace('service', '', $class) . 'Service';
        $instance = $this->getClass(app_path('Service'), $service);
        if (!empty($instance)) {
            $class = $instance['namespace'] . DIRECTORY_SEPARATOR . $instance['class'];
            return app()->make($class);
        }
        return null;
    }

    /**
     * @param string $directory
     * @param string $service
     * @return array|null
     */
    private function getClass(string $directory, string $service): ?array
    {
        $interator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));
        $files = new \RegexIterator($interator, '/\.php$/');
        foreach ($files as $file) {
            require_once $file->getPathname();
            $classe = pathinfo($file->getPathname(), PATHINFO_FILENAME);
            $namespace = $this->getNamespace($file->getPathname());
            if ($classe == $service) {
                return [
                    'namespace' => $namespace,
                    'class' => $classe
                ];
            }
        }
        return null;
    }

    /**
     * @param string $filePath
     * @return string|null
     */
    private function getNamespace(string $filePath): ?string
    {
        $content = file_get_contents($filePath);
        $namespaceRegex = '/namespace\s+([^\s;]+)/i';
        if (preg_match($namespaceRegex, $content, $matches)) {
            return $matches[1];
        }
        return null;
    }
}
