<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Especialidad extends Model
{
    use HasFactory;

    protected $table = 'tb_app_especialidades';

    protected $primaryKey = 'especialidad_id';

    protected $fillable = [
        'cargo_grado_id,especialidad,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    public function crud_especialidades(Request $request, $evento) {
        $db = DB::select("exec pr_crud_app_especialidades ?,?,?,?,?,?",
                        [
                            $evento,
                            $request->input('especialidad_id'),
                            $request->input('cargo_grado_id'),
                            $request->input('especialidad'),
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);

        return $db;
    }

    public function get_especialidades() {
        $db = DB::select("exec pr_get_app_especialidades");
        return $db;
    }

    public function get_especialidades_by_cargo_grado_id(Request $request) {
        $db = DB::select("exec pr_get_app_especialidades_by_cargo_grado_id ?", [ $request->input('cargo_grado_id') ]);
        return $db;
    }
}
