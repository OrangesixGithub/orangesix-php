<?php

namespace Orangesix\Repository;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

/**
 * Repository - DEFAULT
 */
class DefaultRepository implements Repository
{
    use RepositoryDataBase;

    /**
     * Realiza a pesquisa - DEFAULT
     */
    public function findAll(?Request $request = null, string $exec = 'paginate' | 'get'): Builder|Collection
    {
        $filter = $this->filter($request);

        $query = $this->model::query()
            ->select(array_merge(['*'], $this->fields));

        $this->getQueryFilter($query, $filter, ['ativo' => 'asc', 'id' => 'desc']);
        if ($exec == 'get') {
            return $query->get();
        }
        return $query;
    }

    /*
    |--------------------------------------------------------
    | Métodos privados
    |--------------------------------------------------------
    | Utilizados para executar regras específicas na gestão
    | das pessoas.
    |
    */

    /**
     * Aplica o filtro - DEFAULT
     */
    private function filter(Request|array|null $request): array
    {
        $filtered = $this->getQueryFilterToArray($request);

        $query = [];

        if (!empty($this->filters)) {
            foreach ($this->filters as $name => $callback) {
                $callback($filtered, $query);
            }
        }

        return array_merge($filtered, ['query' => $query ?? []], ['order' => $this->getQueryFilterOrder($filtered)]);
    }
}
