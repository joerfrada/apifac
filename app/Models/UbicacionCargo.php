<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UbicacionCargo extends Model
{
    use HasFactory;

    protected $table = 'tb_app_ubicacion_cargos';

    protected $primaryKey = 'ubicacion_cargo_id';

    protected $fillable = [
        'cargo_configuracion_id,nivel_id,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    public function get_ubicacion_cargos_by_id(Request $request) {
        $db = DB::select('exec pr_get_app_ubicaciones_cargos_by_id ?',
                        [
                            $request->input('cargo_configuracion_id')
                        ]);
        return $db;
    }

    public function crud_ubicacion_cargos(Request $request, $evento) {
        $db = DB::select('exec pr_crud_app_ubicacion_cargos ?,?,?,?,?,?,?,?,?,?',
                        [
                            $evento,
                            $request->input('ubicacion_cargo_id'),
                            $request->input('cargo_configuracion_id'),
                            $request->input('nivel_id1'),
                            $request->input('nivel_id2'),
                            $request->input('nivel_id3'),
                            $request->input('nivel_id4'),
                            $request->input('nivel_id5'),
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);
        return $db;
    }
}
