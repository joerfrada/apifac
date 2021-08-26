<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\DB;

class PerfilUsuario extends Model
{
    use HasFactory;

    protected $table = 'tb_app_perfiles_usuarios';

    protected $primaryKey = 'perfil_usuario_id';

    protected $fillable = [
        'perfil_id,usuario_id,tipo_perfil,activo'
    ];
}
