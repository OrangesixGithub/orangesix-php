<?php

namespace Orangecode\Helpers\Acl\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissoesUsuario extends Model
{
    use HasFactory;

    /** @var string  */
    public $table = "acl_permissoes_usuario";
}
