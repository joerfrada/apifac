<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\DB;

class Perfil extends Model
{
    use HasFactory;

    protected $table = 'tb_app_perfiles';

    protected $primaryKey = 'perfil_id';

    protected $fillable = [
        'nombres,apellidos,correo_electronico,avatar,activo'
    ];
}
