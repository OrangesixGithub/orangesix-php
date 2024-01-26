<?php

namespace Orangecode\Helpers\Acl\Repository;

use Orangecode\Helpers\Acl\Model\PerfilPermissoes;
use Orangecode\Helpers\Repository\Repository;
use Orangecode\Helpers\Repository\RepositoryDataBase;

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
