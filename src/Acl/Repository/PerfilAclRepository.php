<?php

namespace Orangecode\Acl\Repository;

use Orangecode\Acl\Model\Perfil;
use Orangecode\Repository\Repository;
use Orangecode\Repository\RepositoryDataBase;

class PerfilAclRepository implements Repository
{
    use RepositoryDataBase;

    /** @var Perfil  */
    private Perfil $model;

    /**
     * @param Perfil $perfil
     */
    public function __construct(Perfil $perfil)
    {
        $this->model = $perfil;
    }
}
