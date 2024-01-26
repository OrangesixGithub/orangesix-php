<?php

namespace Orangecode\Helpers\Acl\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfilPermissoes extends Model
{
    use HasFactory;

    /** @var string  */
    public $table = "acl_perfil_permissoes";
}
