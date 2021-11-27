<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Requerimiento extends Model
{
    use HasFactory;

    protected $table = 'tb_app_requerimientos';

    protected $primaryKey = 'requerimiento_id';

    protected $fillable = [
        'requerimiento,categoria_id,especialidad_id,especialidad,grado_id,grado,activo,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    public function crud_requerimientos(Request $request, $evento) {
        $db = DB::select("exec pr_crud_app_requerimientos ?,?,?,?,?,?,?,?,?,?,?",
                        [
                            $evento,
                            $request->input('requerimiento_id'),
                            $request->input('requerimiento'),
                            $request->input('categoria_id'),
                            $request->input('especialidad_id'),
                            $request->input('especialidad'),
                            $request->input('grado_id'),
                            $request->input('grado'),
                            $request->input('activo') == true ? 'S' : 'N',
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);
        return $db;
    }

    public function get_requerimientos(Request $request) {
        $db = DB::select("exec pr_get_app_requerimientos ?,?", 
                        [
                            $request->input('filtro'),
                            $request->input('filtro') + 200
                        ]);
        return $db;
    }
}
