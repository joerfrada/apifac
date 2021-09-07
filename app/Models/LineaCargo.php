<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LineaCargo extends Model
{
    use HasFactory;

    protected $table = 'tb_app_lineas_cargos';

    protected $primaryKey = 'linea_cargo_id';

    protected $fillable = [
        'ruta_carrera_id,cargo_ruta_id,tipo_ruta_id,tipo_cargo_id,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    public function crud_lineas_cargos(Request $request, $evento) {
        $db = DB::select("exec pr_crud_app_lineas_cargos ?,?,?,?,?,?,?,?,?", 
                        [
                            $evento,
                            $request->input('linea_cargo_id'),
                            $request->input('ruta_carrera_id'),
                            $request->input('cargo_ruta_id'),
                            $request->input('tipo_ruta_id'),
                            $request->input('tipo_cargo_id'),
                            $request->input('activo') == true ? 'S' : 'N',
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);
        return $db;
    }

    public function get_lineas_cargos_by_ruta_carrera_id(Request $request) {
        $db = DB::select("exec pr_get_app_lineas_cargos_by_ruta_carrera_id ?", array($request->input('ruta_carrera_id')));
        return $db;
    }
}
