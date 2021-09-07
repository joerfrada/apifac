<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\RutaCarrera;
use App\Models\LineaCargo;

class RutaCarreraController extends Controller
{
    public function getRutaCarrera(Request $request) {
        $model = new RutaCarrera();

        $datos = $model->get_ruta_carrera($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function crearRutaCarrera(Request $request) {
        $model = new RutaCarrera();

        try {
            $db = $model->crud_ruta_carrera($request, 'C');

            if ($db) {
                $id = $db[0]->id;

                $response = json_encode(array('mensaje' => 'Fue creado exitosamente.', 'tipo' => 0, 'id' => $id), JSON_NUMERIC_CHECK);
                $response = json_decode($response);

                return response()->json($response, 200);
            }
        }
        catch (Exception $e) {
            return response()->json(array('tipo' => -1, 'mensaje' => $e));
        }
    }

    public function actualizarRutaCarrera(Request $request) {
        $model = new RutaCarrera();

        try {
            $db = $model->crud_ruta_carrera($request, 'U');

            if ($db) {
                $response = json_encode(array('mensaje' => 'Fue actualizado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
                $response = json_decode($response);

                return response()->json($response, 200);
            }
        }
        catch (Exception $e) {
            return response()->json(array('tipo' => -1, 'mensaje' => $e));
        }
    }

    public function getLineasCargos(Request $request) {
        $model = new LineaCargo();

        $datos = $model->get_lineas_cargos_by_ruta_carrera_id($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function crearLineasCargos(Request $request) {
        $model = new LineaCargo();

        try {
            $db = $model->crud_lineas_cargos($request, 'C');

            if ($db) {
                $id = $db[0]->id;

                $response = json_encode(array('mensaje' => 'Fue creado exitosamente.', 'tipo' => 0, 'id' => $id), JSON_NUMERIC_CHECK);
                $response = json_decode($response);

                return response()->json($response, 200);
            }
        }
        catch (Exception $e) {
            return response()->json(array('tipo' => -1, 'mensaje' => $e));
        }
    }

    public function actualizarLineasCargos(Request $request) {
        $model = new RutaCarrera();

        try {
            $db = $model->crud_lineas_cargos($request, 'U');

            if ($db) {
                $response = json_encode(array('mensaje' => 'Fue actualizado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
                $response = json_decode($response);

                return response()->json($response, 200);
            }
        }
        catch (Exception $e) {
            return response()->json(array('tipo' => -1, 'mensaje' => $e));
        }
    }
}
