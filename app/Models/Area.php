<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Area extends Model
{
    use HasFactory;

    protected $table = 'tb_app_areas';

    protected $primaryKey = 'area_id';

    protected $fillable = [
        'cargo_grado_id,area,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    // Crear/Actuallizar
    public function crud_areas(Request $request, $evento) {
        $db = DB::select("exec pr_crud_app_areas ?,?,?,?,?,?", 
                        [
                            $evento,
                            $request->input('area_id'),
                            $request->input('cargo_grado_id'),
                            $request->input('area'),
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);
        return $db;
    }

    public function get_areas_by_cargo_grado_id(Request $request) {
        $db = DB::select("exec pr_get_app_areas_by_cargo_grado_id ?", [ $request->input('cargo_grado_id') ]);
        return $db;
    }
}
