<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Educacion extends Model
{
    use HasFactory;

    protected $table = 'tb_app_educacion_conocimientos';

    protected $primaryKey = 'educacion_conocimiento_id';

    protected $fillable = [
        'cargo_grado_id,educacion,conocimiento,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    public function crud_educacion_conocimientos(Request $request, $evento) {
        $db = DB::select("exec pr_crud_app_cuerpos ?,?,?,?,?,?,?",
                        [
                            $evento,
                            $request->input('educacion_conocimiento_id'),
                            $request->input('cargo_grado_id'),
                            $request->input('educacion'),
                            $request->input('conocimiento'),
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);

        return $db;
    }

    public function get_educacion_conocimientos_by_cargo_grado_id(Request $request) {
        $db = DB::select("exec pr_get_app_educacion_conocimientos_by_cargo_grado_id ?", [ $request->input('cargo_grado_id') ]);
        return $db;
    }
}
