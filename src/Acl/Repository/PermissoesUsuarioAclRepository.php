<?php

namespace Orangecode\Helpers\Acl\Repository;

use Orangecode\Helpers\Acl\Model\PermissoesUsuario;
use Orangecode\Helpers\Repository\Repository;
use Orangecode\Helpers\Repository\RepositoryDataBase;

class PermissoesUsuarioAclRepository implements Repository
{
    use RepositoryDataBase;

    /** @var PermissoesUsuario  */
    private PermissoesUsuario $model;

    /**
     * @param PermissoesUsuario $perfil
     */
    public function __construct(PermissoesUsuario $perfil)
    {
        $this->model = $perfil;
    }
}
