<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsuarioMenu extends Model
{
    use HasFactory;

    protected $table = 'tb_app_usuarios_menu';

    protected $fillable = [
        'usuario_id,menu_id'
    ];

    public function getUsuarioMenu($usuario_id) {
        $result = DB::select("exec pr_get_app_usuarios_menu_id ?", array($usuario_id));

        return $result;
    }
}
