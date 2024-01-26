<?php

namespace Orangecode\Acl\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Orangecode\Service\ServiceBase;
use Orangecode\Service\Response\ServiceResponse;
use Orangecode\Acl\Repository\PerfilAclRepository;

class PerfilAclService extends ServiceBase
{
    /**
     * @param PerfilAclRepository $repository
     * @param ServiceResponse $response
     */
    public function __construct(PerfilAclRepository $repository, ServiceResponse $response)
    {
        parent::__construct($repository, $response);
    }

    /**
     * Realiza a pesquisa do perfil por filial
     * @param int $filial
     * @return Collection
     */
    public function findFilial(int $filial): Collection
    {
        return $this->getModel()::where('id_filial', $filial)
            ->get()
            ->map(function ($item) {
                $data = $item;
                $data->label = $item->nome;
                return $data;
            });
    }

    /**
     * @param Request $request
     * @return array
     */
    public function validated(Request $request): array
    {
        return $request->validate([
            'id' => $request->type === 'update' ? 'required' : '',
            'nome' => 'required',
            'id_filial' => 'required'
        ]);
    }
}
