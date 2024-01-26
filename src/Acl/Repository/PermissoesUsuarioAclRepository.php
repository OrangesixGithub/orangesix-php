<?php

namespace Orangecode\Acl\Repository;

use Orangecode\Acl\Model\PermissoesUsuario;
use Orangecode\Repository\Repository;
use Orangecode\Repository\RepositoryDataBase;

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
