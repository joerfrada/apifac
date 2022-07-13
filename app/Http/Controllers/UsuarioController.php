<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;
use Log;

use App\Models\Menu;
use App\Models\Usuario;
use App\Models\UsuarioMenu;
use App\Models\UsuarioRol;

class UsuarioController extends Controller
{
    public function login(Request $request) {
        $p_usuario = $request->get('usuario');
        $p_password = $request->get('password');
        
        $m_usuario = new Usuario();

        // $users = $m_usuario->checkLogin($p_usuario, $p_password);

        // if ($users == true) {
        //     $response = json_encode(array('mensaje' => 'Conectado!', 'tipo' => 0), JSON_NUMERIC_CHECK);
        //     $response = json_decode($response);

        //     return response()->json($response, 200);
        // }
        // else {
        //     $response = json_encode(array('mensaje' => 'Error!', 'tipo' => -1), JSON_NUMERIC_CHECK);
        //     $response = json_decode($response);

        //     return response()->json($response, 200);
        // }

        try {
            $users = DB::table('tb_app_usuarios')->where('usuario', $p_usuario)->get();

            if (!$users->isEmpty()) {
                $usuario = $m_usuario->getLoginUsuario($p_usuario);

                $m_menu = new Menu();
                $m_usuariomenu = new UsuarioMenu();

                $data = array();
                foreach ($usuario as $row) {
                    $tmp = array();
                    $tmp['usuario_id'] = $row->usuario_id;
                    $tmp['usuario'] = $row->usuario;
                    $tmp['nombre_completo'] = $row->nombre_completo;
                    // $tmp['avatar'] = $row->avatar;
                    // $tmp['correo_electronico'] = $row->correo_electronico;
                    // $tmp['tipo_perfil'] = $row->tipo_perfil;
                    $tmp['menus'] = $m_menu->get_menu_id($m_usuariomenu->getUsuarioMenu($row->usuario_id));

                    array_push($data, $tmp);
                }

                $user = Usuario::first();
                // JWTAuth::factory()->setTTL(30);
                $token = JWTAuth::fromUser($user);

                $response = json_encode(array('result' => $data), JSON_NUMERIC_CHECK);
                $response = json_decode($response);
                return response()->json(array('user' => $response, 'tipo' => 0, 'token' => $token));
            }
        }
        catch (\PDOException $e) {
            if ($e->getCode() == "08001") {
                return response()->json(array('tipo' => -1, 'mensaje' => "No se puede conectar a la base de datos. Contactar al administrador."));
            }
            else {
                return response()->json(array('tipo' => -1, 'mensaje' => "El usuario no existe, vuelve a ingresar."));
            }
        }
    }

    public function getUsuarios(Request $request) {
        $model = new Usuario();

        $datos = $model->get_usuarios($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getUsuariosFull(Request $request) {
        $model = new Usuario();

        $datos = $model->get_usuarios_full($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function crearUsuarios(Request $request) {
        $model = new Usuario();

        try {
            $db = $model->crud_usuarios($request, 'C');

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

    public function actualizarUsuarios(Request $request) {
        $model = new Usuario();
        
        try {
            $db = $model->crud_usuarios($request, 'U');

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

    public function getUsuariosRolesById(Request $request) {
        $model = new UsuarioRol();

        $datos = $model->get_usuarios_roles_by_usuario_id($request);

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function crearUsuarioRol(Request $request) {
        $model = new UsuarioRol();

        try {
            $db = $model->crud_usuarios_roles($request, 'C');

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

    public function actualizarUsuarioRol(Request $request) {
        $model = new UsuarioRol();

        try {
            $db = $model->crud_usuarios_roles($request, 'U');

            if ($db) {
                $response = json_encode(array('mensaje' => 'Fue creado exitosamente.', 'tipo' => 0), JSON_NUMERIC_CHECK);
                $response = json_decode($response);

                return response()->json($response, 200);
            }
        }
        catch (Exception $e) {
            return response()->json(array('tipo' => -1, 'mensaje' => $e));
        }
    }

    public function getRolPrivilegiosPantalla() {
        $model = new UsuarioRol();

        $datos = $model->get_rol_privilegios_pantalla();

        $response = json_encode(array('result' => $datos, 'tipo' => 0), JSON_NUMERIC_CHECK);
        $response = json_decode($response);

        return response()->json($response, 200);
    }

    public function getAuthenticatedUser() {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } 
        catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['tipo' => -1, 'codigo' => 1, 'mensaje' => 'Token no es válido.'], $e->getStatusCode());
            }
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['tipo' => -1, 'codigo' => 2, 'mensaje' => 'La sesión ha expirado. Intente conectarse nuevamente.'], $e->getStatusCode());
            }
            else {
                return response()->json(['tipo' => -1, 'codigo' => 3, 'mensaje' => 'No autorizado'], $e->getStatusCode());
            }
        }

        return response()->json(compact('user'));
    }
}
