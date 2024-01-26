<?php

namespace Orangecode\Helpers\Acl\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Orangecode\Helpers\Service\ServiceBase;
use Orangecode\Helpers\Service\Response\ServiceResponse;
use Orangecode\Helpers\Acl\Repository\PerfilAclRepository;

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
        return $this->getModel()::where("id_filial", $filial)
            ->get()
            ->map(function ($item){
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
            "id" => $request->type === "update" ? "required" : "",
            "nome" => "required",
            "id_filial" => "required"
        ]);
    }
}
