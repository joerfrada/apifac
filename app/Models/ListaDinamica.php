<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ListaDinamica extends Model
{
    use HasFactory;

    protected $table = 'tb_app_nombres_listas';

    protected $primaryKey = 'nombre_lista_id';

    protected $fillable = [
        'nombre_lista,descripcion,nombre_lista_padre_id,activo'
    ];
}
