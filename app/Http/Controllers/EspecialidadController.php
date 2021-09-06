<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Especialidad;

class EspecialidadController extends Controller
{
    public function getEspecialidadesFull() {
        $model = new Especialidad();

        $datos = $model->get_especialidades_full();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }
}
