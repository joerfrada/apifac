<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use JWTFactory;
use Tymon\JWTAuth\Exceptions\JWTException;

use App\Models\Menu;
use App\Models\Usuario;
use App\Models\UsuarioMenu;

class UsuarioController extends Controller
{
    public function login(Request $request) {
        $p_usuario = $request->get('usuario');
        $p_password = $request->get('password');

        // Active Directory server (Windows Server) or OpenLDAP (Linux)
        $ldaphost = "ldap.linuxhacking.local";
        $ldapport = 389;

        //user dn
        $ldapusername = "uid=".$p_usuario.",ou=users,dc=linuxhacking,dc=local";
        $ldappassword = $p_password;

        // connect to active directory
        $ldapconn = ldap_connect($ldaphost, $ldapport);

        // set connection is using protocol version 3, if not will occur warning error.
        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);

        if ($ldapconn)
        {
            $ldapbind = @ldap_bind($ldapconn, $ldapusername, $ldappassword);
            
            if ($ldapbind)
            {
                $m_usuario = new Usuario();

                $usuario = $m_usuario->getLoginUsuario($p_usuario);

                $m_menu = new Menu();
                $m_usuariomenu = new UsuarioMenu();

                $data = array();
                foreach ($usuario as $row) {
                    $tmp = array();
                    $tmp['usuario_id'] = $row->usuario_id;
                    $tmp['usuario'] = $row->usuario;
                    $tmp['nombre_completo'] = $row->nombre_completo;
                    $tmp['avatar'] = $row->avatar;
                    $tmp['correo_electronico'] = $row->correo_electronico;
                    $tmp['tipo_perfil'] = $row->tipo_perfil;
                    $tmp['menus'] = $m_menu->get_menu_id($m_usuariomenu->getUsuarioMenu($row->usuario_id));

                    array_push($data, $tmp);
                }

                $user = Usuario::first();
                $token = JWTAuth::fromUser($user);

                $response = json_encode(array('result' => $data), JSON_NUMERIC_CHECK);
                $response = json_decode($response);
                return response()->json(array('user' => $response, 'tipo' => 0, 'token' => $token));
            }
            else {
                $response = json_encode(array('result' => [], 'tipo' => -1, 'mensaje' => 'Usuario y/o Contraseña son incorrectos'), JSON_NUMERIC_CHECK);
                $response = json_decode($response);
                return response()->json($response);
            }
        }
        else 
        {
            return response()->json(array('tipo' => -1, 'mensaje' => 'No se puede conectar el servidor LDAP'));
        }
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
}
