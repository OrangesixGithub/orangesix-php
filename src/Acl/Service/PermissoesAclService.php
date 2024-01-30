<?php

namespace Orangecode\Acl\Service;

use Orangecode\Acl\Repository\PermissoesAclRepository;
use Orangecode\Service\ServiceBase;

/**
 * Service - Permissões Acl
 *
 * @method findModulo()
 * @method findGrupo(?int $modulo = null)
 * @method findAll(int $grupo = null)
 * @method findAllUser(?int $grupo = null, ?int $user = null)
 */
class PermissoesAclService extends ServiceBase
{
    public function __construct(PermissoesAclRepository $repository)
    {
        parent::__construct($repository);
    }
}
