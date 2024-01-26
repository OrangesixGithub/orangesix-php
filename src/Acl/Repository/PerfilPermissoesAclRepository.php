<?php

namespace Orangecode\Acl\Repository;

use Orangecode\Acl\Model\PerfilPermissoes;
use Orangecode\Repository\Repository;
use Orangecode\Repository\RepositoryDataBase;

class PerfilPermissoesAclRepository implements Repository
{
    use RepositoryDataBase;

    /** @var PerfilPermissoes  */
    private PerfilPermissoes $model;

    /**
     * @param PerfilPermissoes $perfil
     */
    public function __construct(PerfilPermissoes $perfil)
    {
        $this->model = $perfil;
    }
}
