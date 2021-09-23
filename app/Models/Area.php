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
        'tipo_categoria_id,sigla,area,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    // Crear/Actuallizar
    public function crud_areas(Request $request, $evento) {
        $db = DB::select("exec pr_crud_app_areas ?,?,?,?,?,?,?", 
                        [
                            $evento,
                            $request->input('area_id'),
                            $request->input('tipo_categoria_id'),
                            $request->input('sigla'),
                            $request->input('area'),
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);
        return $db;
    }

    // Obtener los registros
    public function get_areas(Request $request) {
        $db = DB::select("exec pr_get_app_areas ?,?", 
                        [
                            $request->input('filtro'),
                            $request->input('filtro') + 200
                        ]);
        return $db;
    }
}
