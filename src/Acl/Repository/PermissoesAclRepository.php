<?php

namespace Orangecode\Acl\Repository;

use Orangecode\Acl\Model\Permissoes;
use Orangecode\Repository\Repository;
use Orangecode\Repository\RepositoryDataBase;

class PermissoesAclRepository implements Repository
{
    use RepositoryDataBase;

    /** @var Permissoes  */
    private Permissoes $model;

    /**
     * @param Permissoes $perfil
     */
    public function __construct(Permissoes $perfil)
    {
        $this->model = $perfil;
    }
}
