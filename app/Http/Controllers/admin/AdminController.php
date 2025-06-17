<?php

namespace App\Http\Controllers\admin;

use App\Models\Categoria;
use App\Models\Restaurante;
use App\Models\NivelHigiene;
use Illuminate\Http\Request;
use App\Models\OpcionNutritiva;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    //
    public function index()
    {
        $categorias = DB::table('categorias')
        ->join('restaurantes', 'categorias.id', '=', 'restaurantes.categoria_id')
        ->select('categorias.nombre', DB::raw('count(*) as total'))
        ->groupBy('categorias.nombre')
        ->get();

        return view('admin.principal', [
        'totalRestaurantes' => Restaurante::count(),
        'totalCategorias' => Categoria::count(),
        'totalHigiene' => NivelHigiene::count(),
        'totalNutricion' => OpcionNutritiva::count(),
        'categoriasChart' => $categorias,
    ]);
    }
}
