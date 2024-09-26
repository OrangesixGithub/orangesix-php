<?php

namespace Orangesix\Middleware;

use Closure;
use Illuminate\Http\Request;
use Orangesix\Service\Log\LogService;

class LogDB
{
    /**
     * Realiza gestão do Log via banco de dados
     * @param Request $request
     * @param Closure $next
     * @return mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $ignore = config('logging.db_route_ignore');
        (app()->make(LogService::class))->dispatch(empty($ignore) ? [] : $ignore);
        return $next($request);
    }
}
