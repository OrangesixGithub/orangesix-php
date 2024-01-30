<?php

namespace Orangecode\Acl\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orangecode\Service\ServiceBase;
use Orangecode\Acl\Repository\PermissoesUsuarioAclRepository;

/**
 * Service - Permissões Usuário Acl
 *
 * @method findAll(int $grupo, int $user)
 */
class PermissoesUsuarioAclService extends ServiceBase
{
    public function __construct(PermissoesUsuarioAclRepository $repository)
    {
        parent::__construct($repository);
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
            if (empty($request->list)) {
                abort(500, 'Não foi possível localizar a lista de permissões.');
            }
            foreach ($request->list as $list) {
                if (isset($list['active']) && $list['active']) {
                    DB::table('acl_permissoes_usuario')
                        ->upsert([
                            'id_usuario_filial' => $request->id_usuario_filial,
                            'id_permissoes' => $list['id']
                        ], ['id_usuario_filial', 'id_permissoes']);
                } else {
                    DB::table('acl_permissoes_usuario')
                        ->where('id_usuario_filial', $request->id_usuario_filial)
                        ->where('id_permissoes', $list['id'])
                        ->delete();
                }
            }
            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            abort(500, $exception->getMessage());
        }
    }
}
