<?php

namespace Orangecode\Helpers\Acl\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    /** @var string  */
    protected $table = "acl_perfil";
}
