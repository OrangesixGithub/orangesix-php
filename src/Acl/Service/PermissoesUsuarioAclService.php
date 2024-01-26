<?php

namespace Orangecode\Helpers\Acl\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Orangecode\Helpers\Service\ServiceBase;
use Orangecode\Helpers\Service\Response\ServiceResponse;
use Orangecode\Helpers\Acl\Repository\PermissoesUsuarioAclRepository;

class PermissoesUsuarioAclService extends ServiceBase
{
    /** @var PermissoesAclService  */
    private PermissoesAclService $aclPermissoes;

    /**
     * @param PermissoesUsuarioAclRepository $repository
     * @param ServiceResponse $response
     * @param PermissoesAclService $aclPermissoes
     */
    public function __construct(
        PermissoesUsuarioAclRepository $repository,
        ServiceResponse $response,
        PermissoesAclService $aclPermissoes
    )
    {
        parent::__construct($repository, $response);
        $this->aclPermissoes = $aclPermissoes;
    }

    /**
     * Realiza a pesquisa das permissões por usuário
     * @return Collection
     */
    public function findAll(int $grupo, int $user): Collection
    {
        $permissoesUser = DB::table("acl_permissoes_usuario")
            ->where("id_usuario_filial", "=", $user)
            ->get();
        $permissoes = DB::table("usuario_filial_acl_perfil")
            ->select(["acl_perfil_permissoes.id_permissoes"])
            ->join("acl_perfil", "acl_perfil.id", "=", "usuario_filial_acl_perfil.id_acl_perfil")
            ->join("acl_perfil_permissoes", "acl_perfil_permissoes.id_perfil", "=", "acl_perfil.id")
            ->where("usuario_filial_acl_perfil.id_usuario_filial", "=", $user)
            ->get()
            ->groupBy("id_permissoes")
            ->keys()
            ->all();
        return $this->aclPermissoes->getModel()::where("id_permissoes_grupo", $grupo)
            ->whereNotIn("id", $permissoes)
            ->where("ativo", "S")
            ->orderBy("id")
            ->get()
            ->map(function ($item) use ($permissoesUser) {
                $data = $item;
                $data->active = !is_bool($permissoesUser->search(function ($value) use ($item) {
                    return $item->id == $value->id_permissoes;
                }));
                $data->label = $item->id . " -> " . $item->nome;
                return $data;
            });
    }

    /**
     * Realiza a gestão das permissões por usuário
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
                    DB::table("acl_permissoes_usuario")
                        ->upsert([
                            "id_usuario_filial" => $request->id_usuario_filial,
                            "id_permissoes" => $list["id"]
                        ], ["id_usuario_filial", "id_permissoes"]);
                else
                    DB::table("acl_permissoes_usuario")
                        ->where("id_usuario_filial", $request->id_usuario_filial)
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
