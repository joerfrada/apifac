<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CargoConfiguracion extends Model
{
    use HasFactory;

    protected $table = 'tb_app_cargos_configuracion';

    protected $primaryKey = 'cargo_configuracion_id';

    protected $fillable = [
        'cargo_grado_id,puesto_cantidad,cargo_jefe_inmediato_id,cargo_jefe_inmediato,nivel1,nivel2,nivel3,nivel,nivel5,duracion,requisito_cargo,cuerpo,especialidad,area,educacion,conocimiento,experiencia1,experiencia2,experiencia3,experiencia4,experiencia5,competencia1,competencia2,competencia3,competencia4,competencia5,observaciones,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    public function crud_cargos_configuracion(Request $request, $evento) {
        $db = DB::select("exec pr_crud_app_cargos_configuracion ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?",
                        [
                            $evento,
                            $request->input('cargo_configuracion_id'),
                            $request->input('cargo_grado_id'),
                            $request->input('puesto_cantidad'),
                            $request->input('cargo_jefe_inmediato_id'),
                            $request->input('cargo_jefe_inmediato'),
                            $request->input('nivel1'),
                            $request->input('nivel2'),
                            $request->input('nivel3'),
                            $request->input('nivel4'),
                            $request->input('nivel5'),
                            $request->input('duracion'),
                            $request->input('requisito_cargo'),
                            $request->input('cuerpo'),
                            $request->input('especialidad'),
                            $request->input('area'),
                            $request->input('educacion'),
                            $request->input('conocimiento'),
                            $request->input('experiencia1'),
                            $request->input('experiencia2'),
                            $request->input('experiencia3'),
                            $request->input('experiencia4'),
                            $request->input('experiencia5'),
                            $request->input('competencia1'),
                            $request->input('competencia2'),
                            $request->input('competencia3'),
                            $request->input('competencia4'),
                            $request->input('competencia5'),
                            $request->input('observaciones'),
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);
        return $db;
    }

    public function get_cargos_configuracion_by_cargo_grado_id(Request $request) {
        $db = DB::select("exec pr_get_app_cargos_configuracion_by_cargo_grado_id ?", array($request->input('cargo_grado_id')));
        return $db;
    }
}
