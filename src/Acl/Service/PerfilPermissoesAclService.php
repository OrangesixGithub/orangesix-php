<?php

namespace Orangesix\Acl\Service;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Orangesix\Service\ServiceBase;
use Orangesix\Acl\Repository\PerfilPermissoesAclRepository;

/**
 * Service - Perfil Permissões ACL
 *
 * @method findAll(int $perfil, int $grupo)
 */
class PerfilPermissoesAclService extends ServiceBase
{
    public function __construct(PerfilPermissoesAclRepository $repository)
    {
        parent::__construct($repository);
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
            if (empty($request->list)) {
                abort(500, 'Não foi possível localizar a lista de permissões.');
            }
            foreach ($request->list as $list) {
                if (isset($list['active']) && $list['active']) {
                    DB::table('acl_perfil_permissoes')
                        ->upsert([
                            'id_perfil' => $request->id,
                            'id_permissoes' => $list['id']
                        ], ['id_perfil', 'id_permissoes']);
                } else {
                    DB::table('acl_perfil_permissoes')
                        ->where('id_perfil', $request->id)
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
