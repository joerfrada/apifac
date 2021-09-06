<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\DB;
use Illuminate\Http\Request;

class RutaRequisito extends Model
{
    use HasFactory;

    protected $table = 'tb_app_rutas_requisitos';

    protected $primaryKey = 'ruta_requisito_id';

    protected $fillable = [
        'cargo_grado_id,puesto_cantidad,cargo_id,nivel1,nivel2,nivel3,nivel4,nivel5,duracion,requisito_cargo,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    public function crud_rutas_requisitos(Request $request) {
        $db = DB::select("exec pr_crud_app_rutas_requisitos ?,?,?,?,?,?,?,?,?,?,?,?,?,?",
                        [
                            $evento,
                            $request->input('ruta_requisito_id'),
                            $request->input('cargo_grado_id'),
                            $request->input('puesto_cantidad'),
                            $request->input('cargo_id'),
                            $request->input('nivel1'),
                            $request->input('nivel2'),
                            $request->input('nivel3'),
                            $request->input('nivel4'),
                            $request->input('nivel5'),
                            $request->input('duracion'),
                            $request->input('requisito_cargo'),
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);
        return $db;
    }
    
    public function get_rutas_requisitos_by_cargo_grado_id(Request $request) {
        $db = DB::select("exec pr_get_apps_rutas_requisitos_by_cargo_id ?", [ $request->input('cargo_grado_id') ]);
        return $db;
    }
}
