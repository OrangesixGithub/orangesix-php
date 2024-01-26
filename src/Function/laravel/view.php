<?php
if (!function_exists("IsActiveRoute")) {
    /**
     * @param string|array $route
     * @param mixed $return
     * @param mixed $falied
     * @return mixed
     */
    function IsActiveRoute(
        string|array $route,
        mixed        $return = 'active',
        mixed        $falied = ""
    ): mixed
    {
        if (!class_exists("\Illuminate\Support\Facades\Request"))
            return $falied;
        $url = \Illuminate\Support\Facades\Request::url();
        if (is_array($route))
            return in_array($url, $route) ? $return : $falied;
        return $url === $route ? $return : $falied;
    }
}

if (!function_exists('ChangeEnvironmentVariable')) {

    /**
     * Realiza a mudança das variaveis de ambiente
     * @param $key
     * @param $value
     * @return void
     */
    function ChangeEnvironmentVariable($key, $value): bool
    {
        if (function_exists('base_path') && function_exists('env')) {
            $path = base_path('.env');

            if (is_bool(env($key)))
                $old = env($key) ? 'true' : 'false';
            elseif (env($key) === null)
                $old = 'null';
            else
                $old = env($key);

            if (file_exists($path)) {
                return is_int(file_put_contents($path, str_replace(
                    "$key=" . $old, "$key=" . $value, file_get_contents($path)
                )));
            }
        }
        return false;
    }
}
