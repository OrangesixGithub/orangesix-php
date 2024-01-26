<?php

namespace Orangecode\Helpers\Acl\Service;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Orangecode\Helpers\Acl\Repository\PermissoesAclRepository;
use Orangecode\Helpers\Service\Response\ServiceResponse;
use Orangecode\Helpers\Service\ServiceBase;

class PermissoesAclService extends ServiceBase
{
    /**
     * @param PermissoesAclRepository $repository
     * @param ServiceResponse $response
     */
    public function __construct(PermissoesAclRepository $repository, ServiceResponse $response)
    {
        parent::__construct($repository, $response);
    }

    /**
     * Realiza a pesquisa por módulo
     * @return Collection
     */
    public function findModulo(): Collection
    {
        return DB::table("acl_permissoes_modulo")
            ->get()
            ->map(function ($item) {
                $data = $item;
                $data->name = $item->nome;
                return $data;
            });
    }

    /**
     * Realiza a pesquisa do grupo
     * @param int|null $modulo
     * @return Collection
     */
    public function findGrupo(int $modulo = null): Collection
    {
        return DB::table("acl_permissoes_grupo")
            ->when(!empty($modulo) ? $modulo : false, function ($query, $modulo) {
                $query->where("id_permissoes_modulo", $modulo);
            })
            ->get()
            ->map(function ($item) {
                $data = $item;
                $data->name = $item->nome;
                return $data;
            });;
    }

    /**
     * Realiza a pesquisa das permissões
     * @param int|null $grupo
     * @return Collection
     */
    public function findAll(int $grupo = null): Collection
    {
        return DB::table("acl_permissoes")
            ->where("ativo", "S")
            ->when(!empty($grupo) ? $grupo : false, function ($query, $grupo) {
                $query->where("id_permissoes_grupo", $grupo);
            })
            ->get();
    }

    /**
     * Realiza a pesquisa das permissões por usuário
     * @param int|null $grupo
     * @param int|null $user
     * @return Collection
     */
    public function findAllUser(int $grupo = null, int $user = null): Collection
    {
        $permissoes = DB::table("usuario_filial_acl_perfil")
            ->select(["acl_perfil_permissoes.id_permissoes"])
            ->join("acl_perfil", "acl_perfil.id", "=", "usuario_filial_acl_perfil.id_acl_perfil")
            ->join("acl_perfil_permissoes", "acl_perfil_permissoes.id_perfil", "=", "acl_perfil.id")
            ->where("usuario_filial_acl_perfil.id_usuario_filial", "=", $user)
            ->get()
            ->groupBy("id_permissoes")
            ->keys()
            ->all();
        return DB::table("acl_permissoes")
            ->where("ativo", "S")
            ->whereNotIn("id", $permissoes)
            ->when(!empty($grupo) ? $grupo : false, function ($query, $grupo) {
                $query->where("id_permissoes_grupo", $grupo);
            })
            ->get();
    }
}
