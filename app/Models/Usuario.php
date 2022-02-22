<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Http\Request;
use PDO;
use PDOException;

use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'tb_app_usuarios';

    protected $primaryKey = 'usuario_id';

    protected $fillable = [
        'usuario,activo,usuario_creador,fecha_creacion,usuario_modificador,fecha_modificacion'
    ];

    public function checkLogin($username, $password) {
        $host = env('DB_HOST');
        $dbname = env('DB_DATABASE');
        $port = env('PORT');

        try {
            $conn = new PDO("sqlsrv:server=$host,$port;database=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
            $conn->setAttribute(PDO::SQLSRV_ATTR_QUERY_TIMEOUT, 1);

            if ($conn != null) return true;
        }
        catch (PDOException $e) {
            return false;
        }
    }

    public function crud_usuarios(Request $request, $evento) {
        $db = DB::select("exec pr_crud_app_usuarios ?,?,?,?,?,?",
                        [
                            $evento,
                            $request->input('usuario_id'),
                            $request->input('usuario'),
                            $request->input('nombres'),
                            $request->input('apellidos'),
                            $request->input('num_identificacion'),
                            $request->input('activo') == true ? 'S' : 'N',
                            $request->input('usuario_creador'),
                            $request->input('usuario_modificador')
                        ]);
        return $db;
    }

    public function checkUsuario($usuario) {
        $result = DB::select("exec pr_check_usuario ?", array($usuario));
        if (count($result) > 0)
            return true;
        else return false;
    }

    public function getLoginUsuario($usuario) {
        $result = DB::select("exec pr_get_login_usuario ?", array($usuario));

        return $result;
    }

    public function get_usuarios(Request $request) {
        $db = DB::select("exec pr_get_app_usuarios ?,?",
                        [
                            $request->input('filtro'),
                            $request->input('filtro') + 200
                        ]);
        return $db;
    }

    public function get_usuarios_full() {
        $db = DB::select("exec pr_get_app_usuarios_full");
        return $db;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    
    public function getJWTCustomClaims()
    {
        return [];
    }
}
