<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\DB;
use Illuminate\Http\Request;

class RutaCarrera extends Model
{
    use HasFactory;

    protected $table = 'tb_app_ruta_carrera';

    protected $primaryKey = 'ruta_carrera_id';

    protected $fillable = [
        'ruta_carrera_id,cuerpo_id,especialidad_id,descripcion,tipo_categoria_id,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    public function crud_ruta_carrera(Request $request, $evento) {
        $db = DB::select("exec pr_crud_app_ruta_carrera ?,?,?,?,?,?,?,?,?",
                        [
                            $evento,
                            $request->input('ruta_carrera_id'),
                            $request->input('cuerpo_id'),
                            $request->input('especialidad_id'),
                            $request->input('descripcion_id'),
                            $request->input('tipo_categoria_id'),
                            $request->input('activo') == true ? 'S' : 'N',
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);
        return $db;
    }

    public function get_ruta_carrera(Request $request) {
        $db = DB::select("exec pr_get_app_ruta_carrera ?,?", 
                        [
                            $request->input('filtro'),
                            $request->input('filtro') + 200
                        ]);
        return $db;
    }
}
