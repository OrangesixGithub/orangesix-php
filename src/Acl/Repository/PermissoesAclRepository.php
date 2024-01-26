<?php

namespace Orangecode\Helpers\Acl\Repository;

use Orangecode\Helpers\Acl\Model\Permissoes;
use Orangecode\Helpers\Repository\Repository;
use Orangecode\Helpers\Repository\RepositoryDataBase;

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
