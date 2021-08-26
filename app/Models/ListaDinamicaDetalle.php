<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ListaDinamicaDetalle extends Model
{
    use HasFactory;

    protected $table = 'tb_app_listas_dinamicas';

    protected $primaryKey = 'lista_dinamica_id';

    protected $fillable = [
        'orden,nombre_lista_id,lista_dinamica,descripcion,lista_dinamica_padre_id,activo'
    ];
}
