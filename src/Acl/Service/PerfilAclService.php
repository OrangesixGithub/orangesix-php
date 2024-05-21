<?php

namespace Orangesix\Acl\Service;

use Illuminate\Http\Request;
use Orangesix\Service\ServiceBase;
use Orangesix\Acl\Repository\PerfilAclRepository;

/**
 * Service - Perfil Acl
 *
 * @method findAll(int $filial)
 */
class PerfilAclService extends ServiceBase
{
    public function __construct(PerfilAclRepository $repository)
    {
        parent::__construct($repository);
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
