<?php

namespace Orangesix\Http\Resource;

use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaginateResource
{
    /**
     * Retorna o array de paginação
     * @param Builder|EloquentBuilder $query
     * @param string $resource
     * @param Request|null $request
     * @param callable|null $getItens
     * @return array
     */
    public static function toArray(Builder|EloquentBuilder $query, string $resource, ?Request $request = null, ?callable $getItens = null): array
    {
        if (!class_exists($resource) || !is_subclass_of($resource, JsonResource::class)) {
            throw new \InvalidArgumentException("A classe $resource deve ser do tipo de " . JsonResource::class);
        }

        $columns = ['*'];
        $page = empty($request->page) ? 1 : $request->page;
        $perPage = empty($request->elements) ? 15 : $request->elements;

        /**
         * @var $resource JsonResource
         */
        $data = $resource::collection($query->paginate($perPage, $columns, 'page', $page));
        $paginate = $data->resource;
        $itens = $data->toArray(new Request(['action' => 'findAll']));
        return [
            'pagination' => $paginate,
            'itens' => empty($getItens) ? $itens : $getItens($itens)
        ];
    }
}
