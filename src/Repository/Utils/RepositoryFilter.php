<?php

namespace Orangesix\Repository\Utils;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

trait RepositoryFilter
{
    /**
     * Converte o objeto de request em array
     * @param Request|array|null $request
     * @return array
     */
    public function getQueryFilterToArray(Request|array|null $request): array
    {
        if (empty($request)) {
            return [];
        }

        $filtered = collect(is_array($request) ? $request : $request->all());
        $filtered = $filtered->filter(function ($item) {
            return !empty($item);
        })->toArray();

        unset(
            $filtered['page'],
            $filtered['elements']
        );

        return $filtered;
    }

    /**
     * Realiza a montagem da query de pesquisa com ordenação
     * @param array $filtered
     * @return string
     */
    public function getQueryFilterOrder(array $filtered): string
    {
        if (isset($filtered['order'])) {
            return "{$filtered['order']['field']} {$filtered['order']['value']}";
        }
        return '';
    }

    /**
     * Realiza a montagem da query de pesquisa dos módulos com paginação
     * @param Builder|EloquentBuilder $query
     * @param array $filter
     * @return void
     */
    public function getQueryFilter(Builder|EloquentBuilder &$query, array $filter, string|array $orderBy = 'id'): void
    {
        foreach ($filter as $field => $value) {
            if (is_string($value) && $field != 'order') {
                $data = explode('&', $value);
                if (count($data) == 1 && $field != 'id') {
                    $query->where($field, '=', $value);
                }
            }

            if (is_array($value) && $field != 'query' && $field !== 'order') {
                $query->whereIn($field, $value);
            }

            if ($field == 'id') {
                $query->where('id', 'LIKE', "%{$value}%");
            }

            if (is_array($value) && $field == 'query') {
                foreach ($value as $qy) {
                    $query->whereRaw($qy);
                }
            }
        }

        if (!isset($filter['order']) || empty($filter['order'])) {
            if (is_string($orderBy)) {
                $query->orderBy($orderBy);
            } else {
                foreach ($orderBy as $key => $type) {
                    $query->orderBy($key, $type);
                }
            }
        } else {
            $query->orderByRaw($filter['order']);
        }
    }
}
