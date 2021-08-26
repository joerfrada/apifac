<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'tb_app_menu';

    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'menu_nombre,tipo,menu_padre_id,icono,tooltip,url,activo'
    ];

    public function getMenus()
    {
        $menus = DB::select("exec pr_get_app_menu");

        return $menus;
    }

    public function getMenusById($menus) {
        $data = array();
        foreach($menus as $row) {
            $tmp = array();
            $tmp['menu_id'] = $row->menu_id;
            $tmp['titulo'] = $row->nombre_menu;
            $tmp['tipo'] = $row->tipo;
            $tmp['menu_padre_id'] = $row->menu_padre_id;
            $tmp['icono'] = $row->icono;
            $tmp['tooltip'] = $row->tooltip;
            $tmp['url'] = $row->url;
            $tmp['submenus'] = array();

            array_push($data, $tmp);
        }

        $result = $this->makeNested($data);

        return $result;
    }

    public function makeNested($data, $padre_id = 0) {
        $tree = array();
        foreach ($data as $d) {
            if ($d['menu_padre_id'] == $padre_id) {
                $submenus = $this->makeNested($data, $d['menu_id']);
                if (!empty($submenus)) {
                    $d['submenus'] = $submenus;
                }
                $tree[] = $d;
            }
        }
        return $tree;
    }
}
