<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Demo;

class DemoController extends Controller
{
    public function crearDemos(Request $request) {
        $model = new Demo();

        try {
            $demo = $model->crud_demos($request, 'C');

            if ($demo) {
                $id = $demo[0]->id;

                $response = json_encode(array('mensaje' => 'Fue creado exitosamente.', 'tipo' => 0, 'id' => $id), JSON_NUMERIC_CHECK);
                $response = json_decode($response);

                return response()->json($response, 200);
            }
        }
        catch (Exception $e) {
            return response()->json(array('tipo' => -1, 'mensaje' => $e));
        }
    }

    public function actualizarDemos(Request $request) {
        $model = new Demo();

        try {
            $demo = $model->crud_demos($request, 'U');

            if ($demo) {
                $response = json_encode(array('mensaje' => 'Fue actualizado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
                $response = json_decode($response);

                return response()->json($response, 200);
            }
        }
        catch (Exception $e) {
            return response()->json(array('tipo' => -1, 'mensaje' => $e));
        }
    }

    public function getDemos() {
        $model = new Demo();

        $demo = $model->get_demos();

        $response = json_encode(array('result' => $demo, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response);
    }
}
