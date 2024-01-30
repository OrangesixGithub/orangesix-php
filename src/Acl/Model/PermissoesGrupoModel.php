<?php

namespace Orangecode\Acl\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissoesGrupoModel extends Model
{
    use HasFactory;

    /** @var string */
    public $table = 'acl_permissoes_grupo';
}
