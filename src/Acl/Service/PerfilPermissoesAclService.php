<?php

namespace Orangecode\Helpers\Acl\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Orangecode\Helpers\Service\ServiceBase;
use Orangecode\Helpers\Service\Response\ServiceResponse;
use Orangecode\Helpers\Acl\Repository\PerfilPermissoesAclRepository;

class PerfilPermissoesAclService extends ServiceBase
{
    /** @var PermissoesAclService  */
    private PermissoesAclService $aclPermissoes;

    /**
     * @param PerfilPermissoesAclRepository $repository
     * @param ServiceResponse $response
     * @param PermissoesAclService $aclPermissoes
     */
    public function __construct(PerfilPermissoesAclRepository $repository, ServiceResponse $response, PermissoesAclService $aclPermissoes)
    {
        parent::__construct($repository, $response);
        $this->aclPermissoes = $aclPermissoes;
    }

    /**
     * Realiza a pesquisa das permissões para perfil
     * @param int $perfil
     * @return Collection
     */
    public function findAll(int $perfil, int $grupo): Collection
    {
        $perfilPermissoes = DB::table("acl_perfil_permissoes")
            ->where("id_perfil", $perfil)
            ->get();
        return $this->aclPermissoes->getModel()::where("id_permissoes_grupo", $grupo)
            ->where("ativo", "S")
            ->orderBy("id")
            ->get()
            ->map(function ($item) use ($perfilPermissoes) {
                $data = $item;
                $data->active = !is_bool($perfilPermissoes->search(function ($value) use ($item) {
                    return $item->id == $value->id_permissoes;
                }));
                $data->label = $item->id . " -> " . $item->nome;
                return $data;
            });
    }

    /**
     * Realiza a gestão das permissões por perfil
     * @param Request $request
     * @return mixed
     */
    public function manager(Request $request): mixed
    {
        try {
            DB::beginTransaction();
            if (empty($request->list))
                abort(500, "Não foi possível localizar a lista de permissões.");
            foreach ($request->list as $list)
                if (isset($list["active"]) && $list["active"])
                    DB::table("acl_perfil_permissoes")
                        ->upsert([
                            "id_perfil" => $request->id,
                            "id_permissoes" => $list["id"]
                        ], ["id_perfil", "id_permissoes"]);
                else
                    DB::table("acl_perfil_permissoes")
                        ->where("id_perfil", $request->id)
                        ->where("id_permissoes", $list["id"])
                        ->delete();
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, $exception->getMessage());
        }
    }
}
