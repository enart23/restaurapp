<?php

namespace App\Http\Controllers\client;

use App\Models\ImagenRestaurante;
use App\Models\Categoria;
use App\Models\Restaurante;
use App\Models\RangoPrecio;
use App\Models\NivelHigiene;
use App\Models\OpcionNutritiva;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        // Consulta base con relaciones
    $query = Restaurante::with(['rangoPrecio', 'nivelHigiene', 'opcionesNutritivas', 'imagenDestacada','categoria']);

    // Filtros si se enviaron
    $query->where(function ($q) use ($request) {
    $hasAnyFilter = false;

    if ($request->filled('precio')) {
        $q->orWhere('rangos_precio_id', $request->precio);
        $hasAnyFilter = true;
    }

    if ($request->filled('higiene')) {
        $q->orWhere('nivel_higiene_id', $request->higiene);
        $hasAnyFilter = true;
    }

    if ($request->filled('nutricion')) {
        $q->orWhereHas('opcionesNutritivas', function ($subq) use ($request) {
            $subq->where('opcion_nutritiva_id', $request->nutricion);
        });
        $hasAnyFilter = true;
    }

    // Si no se aplicó ningún filtro, que no filtre nada
    if (!$hasAnyFilter) {
        $q->whereRaw('1 = 0'); // evita mostrar todo si no hay filtro activo
    }
    //
    });

    
    
    // Obtener resultados
    $restaurantes = $query->get();
    $totalRestaurantes = Restaurante::count(); // total sin filtros
    $filtrados = $restaurantes->count();       // los que se están mostrando
    
    // Enviar todo a la vista
    return view('client.index', [
        'restaurantes' => $restaurantes,
        'categorias' => Categoria::all(),
        'rangosPrecio' => RangoPrecio::all(),
        'nivelHigiene' => NivelHigiene::all(),
        'opcionesNutritivas' => OpcionNutritiva::all(),
        'totalRestaurantes' => $totalRestaurantes,
        'filtrados' => $filtrados,
        
    ]);
    
    }
    public function about(){
        return view('client.sobreNosotros');
    }
    
    public function miCuenta(){
        return view('client.miCuenta');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
