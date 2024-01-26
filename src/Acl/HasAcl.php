<?php

namespace Orangecode\Helpers\Acl;

use Illuminate\Support\Facades\DB;
use Orangecode\Helpers\Acl\Exceptions\Acl;

trait HasAcl
{
    /**
     * Realiza a validação da permissão parametrizada
     * @param int|array $permission
     * @param bool $exception
     * @return bool
     */
    public static function acl(int|array $permission, bool $exception = false): bool
    {
        $acl = session()->get("acl_" . self::$acl_app . "_permissions");
        $validated = false;
        if (is_array($acl)) {
            if (is_int($permission))
                $validated = in_array($permission, $acl);
            else
                $validated = collect($acl)->filter(function ($item) use ($permission) {
                        return in_array($item, $permission);
                    })->count() > 0;
        }
        if ($exception && !$validated)
            throw new Acl("Você não possui permissão para acessar este recurso!", 403);
        return $validated;
    }

    /**
     * Obtém o array de permissões de acordo com parâmetro
     * @param int|array $permission
     * @return array | bool
     */
    public static function getAcl(int|array $permission): array | bool
    {
        $acl = session()->get("acl_" . self::$acl_app . "_permissions");
        if (is_int($permission))
            return in_array($permission, $acl);
        $result = [];
        foreach ($permission as $item)
            $result[$item] = in_array($item, $acl);
        return $result;
    }

    /**
     * Realiza o carregamento das permissões
     * @param int $id_filial
     * @return void
     */
    public function aclLoadPermissions(int $id_filial): void
    {
        $perfil = DB::table("acl_perfil")
            ->select("acl_perfil.*")
            ->join("usuario_filial_acl_perfil", "usuario_filial_acl_perfil.id_acl_perfil", "=", "acl_perfil.id")
            ->join("usuario_filial", "usuario_filial.id", "=", "usuario_filial_acl_perfil.id_usuario_filial")
            ->where("acl_perfil.id_filial", $id_filial)
            ->where("usuario_filial.id_usuario", $this->id)
            ->get()
            ->groupBy("id")
            ->keys()
            ->all();

        $permissoesPerfil = DB::table("acl_perfil_permissoes")
            ->select([
                "acl_permissoes.id"
            ])
            ->join("acl_permissoes", "acl_permissoes.id", "=", "acl_perfil_permissoes.id_permissoes")
            ->whereIn("acl_perfil_permissoes.id_perfil", $perfil)
            ->where("acl_permissoes.ativo", "=", "S");

        $permissoesUsuario = DB::table("acl_permissoes_usuario")
            ->select([
                "acl_permissoes.id"
            ])
            ->join("usuario_filial", "usuario_filial.id", "=", "acl_permissoes_usuario.id_usuario_filial")
            ->join("acl_permissoes", "acl_permissoes.id", "=", "acl_permissoes_usuario.id_permissoes")
            ->where("usuario_filial.id_filial", $id_filial)
            ->where("usuario_filial.id_usuario", $this->id)
            ->union($permissoesPerfil)
            ->get();
        session(["acl_" . self::$acl_app . "_permissions" => $permissoesUsuario->groupBy("id")->keys()->all()]);
    }
}
