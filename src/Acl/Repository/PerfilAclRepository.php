<?php

namespace Orangecode\Helpers\Acl\Repository;

use Orangecode\Helpers\Acl\Model\Perfil;
use Orangecode\Helpers\Repository\Repository;
use Orangecode\Helpers\Repository\RepositoryDataBase;

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
