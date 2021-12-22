<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\RutaCarrera;
use App\Models\LineaCargo;
use App\Models\Ruta;
use App\Models\Cuerpo;
use App\Models\Especialidad;
use App\Models\Area;

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
        $model = new LineaCargo();

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

    public function getRutaCarrerabyCargos(Request $request) {
        $model = new RutaCarrera();

        $datos = $model->get_ruta_carrera_by_cargos($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getRutas(Request $request) {
        $model = new Ruta();

        $datos = $model->get_rutas_by_ruta_carrera_id($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function crearRutas(Request $request) {
        $model = new Ruta();

        try {
            $db = $model->crud_rutas($request, 'C');

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

    public function actualizarRutas(Request $request) {
        $model = new Ruta();

        try {
            $db = $model->crud_rutas($request, 'U');

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

    public function getRutasByRutaCarrera(Request $request) {
        $rc_model = new RutaCarrera();
        $r_model = new Ruta(); 

        $rc = $rc_model->get_ruta_carrera_by_id($request);

        $data = array();
        foreach ($rc as $row) {
            $tmp = array();
            $tmp['ruta_carrera_id'] = $row->ruta_carrera_id;
            $tmp['cuerpo_id'] = $row->cuerpo_id;
            $tmp['cuerpo'] = $row->cuerpo;
            $tmp['especialidad_id'] = $row->especialidad_id;
            $tmp['especialidad'] = $row->especialidad;
            $tmp['descripcion'] = $row->descripcion;
            $tmp['tipo_categoria_id'] = $row->tipo_categoria_id;
            $tmp['categoria'] = $row->categoria;
            $tmp['tipo_ruta_id'] = $row->tipo_ruta_id;
            $tmp['tipo_ruta'] = $row->tipo_ruta;
            $tmp['rutas'] = $r_model->get_rutas_ruta_carrera_id($row->ruta_carrera_id);

            array_push($data, $tmp);
        }

        $response = json_encode(array('result' => $data, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);
        return response()->json($response, 200);
    }

    public function getCargosByRutas(Request $request) {
        $model = new Ruta();

        $datos = $model->get_cargos_by_rutas($request);

        $data = array();
        foreach ($datos as $row) {
            $tmp = array();
            $tmp['id'] = $row->id;
            $tmp['grado'] = $row->grado;
            $tmp['grado_id'] = $row->grado_id;
            $tmp['cargo'] = $row->cargo;
            $tmp['cargo_id'] = $row->cargo_id;
            $tmp['className'] = $row->className;
            $tmp['parent_id'] = $row->parent_id;
            $tmp['children'] = array();

            array_push($data, $tmp);
        }

        $result = $model->buildTree($data);

        $response = array('result' => current($result), 'tipo' => 0);

        return response()->json($response, 200);
    }

    public function getGradosByEspecialidad(Request $request) {
        $model = new RutaCarrera();

        $datos = $model->get_grados_by_especialidad($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getGradosDetalleByEspecialidad(Request $request) {
        $model = new RutaCarrera();

        $datos = $model->get_grados_detalle_by_especialidad($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getGradosDetalleRequerimiento(Request $request) {
        $model = new RutaCarrera();

        $datos = $model->get_grados_detalle_requerimiento_piramide($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getGradosDetalleCargo(Request $request) {
        $model = new RutaCarrera();

        $datos = $model->get_grados_detalle_cargos_piramide_by_ruta_carrera($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getCuerposByCategoria(Request $request) {
        $model = new Cuerpo();

        $datos = $model->get_cuerpos_by_categoria($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getEspecialidadesByCategoriaCuerpo(Request $request) {
        $model = new Especialidad();

        $datos = $model->get_especialidades_by_categoria_cuerpo($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getAreasByCategoriaEspecialidad(Request $request) {
        $model = new Area();

        $datos = $model->get_areas_by_categoria_especialidad($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getDetalleCargoRutaCarrera(Request $request) {
        $model = new RutaCarrera();

        $datos = $model->get_detalle_cargo_ruta_carrera($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getCuerposEspecialidadesAreasRutaCarrera() {
        $model = new RutaCarrera();

        $datos = $model->get_cuerpos_especialidades_areas_ruta_carrera();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getEspecialidadesRutas() {
        $model = new RutaCarrera();

        $datos = $model->get_app_especialidades_rutas();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }
}
