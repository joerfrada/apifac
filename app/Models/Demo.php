<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class Demo extends Model
{
    use HasFactory;

    protected $table = 'tb_app_demos';

    protected $primaryKey = 'demo_id';

    protected $fillable = [
        'texto1,texto2,fecha_creacion,fecha_modificacion'
    ];

    public function crud_demos(Request $request, $evento) {
        $demo = DB::select('exec pr_crud_app_demos ?,?,?,?',array($evento, $request->input('demo_id'), $request->input('texto1'), $request->input('texto2')));

        return $demo;
    }

    public function get_demos() {
        $demo = DB::select('exec pr_get_app_demos');

        return $demo;
    }
}
