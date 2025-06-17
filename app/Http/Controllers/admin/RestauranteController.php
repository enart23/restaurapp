<?php

namespace App\Http\Controllers\admin;

use App\Models\Restaurante;
use App\Models\Categoria;
use App\Models\NivelHigiene;
use App\Models\RangoPrecio;
use App\Models\OpcionNutritiva;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class RestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $restaurantes = Restaurante::with(['categoria', 'nivelHigiene', 'rangoPrecio', 'opcionesNutritivas'])->get();
        return view('admin.restaurantes.index', ['restaurantes' => $restaurantes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::all();
        $niveles = NivelHigiene::all();
        $rangos = RangoPrecio::all();
        $opciones = OpcionNutritiva::all();
        return view('admin.restaurantes.create', compact('categorias', 'niveles', 'rangos', 'opciones'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $reglas = [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'direccion' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:60',
            'sitio_web' => 'nullable|url|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'nivel_higiene_id' => 'required|exists:niveles_higiene,id',
            'rangos_precio_id' => 'required|exists:rangos_precio,id',
            'opciones_nutritivas' => 'array',
            'opciones_nutritivas.*' => 'exists:opciones_nutritivas,id',
            'destacado' => 'nullable|boolean'
        ];

        $validar = Validator::make($request->all(), $reglas);
        if ($validar->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validar->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $restaurante = Restaurante::create($request->except('opciones_nutritivas'));

            // Many-to-many
            $restaurante->opcionesNutritivas()->sync($request->input('opciones_nutritivas', []));

            DB::commit();
            return response()->json([
                'message' => 'Restaurante registrado exitosamente.',
                'restaurante' => $restaurante
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Error al registrar restaurante'
            ], 500);
        }
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
        $restaurante = Restaurante::with('opcionesNutritivas')->find($id);
        if (!$restaurante) {
            abort(404, 'Restaurante no encontrado');
        }
        $categorias = Categoria::all();
        $niveles = NivelHigiene::all();
        $rangos = RangoPrecio::all();
        $opciones = OpcionNutritiva::all();
        return view('admin.restaurantes.edit', compact('restaurante', 'categorias', 'niveles', 'rangos', 'opciones'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $reglas = [
            'nombre' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'direccion' => 'required|string|max:150',
            'telefono' => 'nullable|string|max:30',
            'email' => 'nullable|email|max:60',
            'sitio_web' => 'nullable|url|max:100',
            'categoria_id' => 'required|exists:categorias,id',
            'nivel_higiene_id' => 'required|exists:niveles_higiene,id',
            'rangos_precio_id' => 'required|exists:rangos_precio,id',
            'opciones_nutritivas' => 'array',
            'opciones_nutritivas.*' => 'exists:opciones_nutritivas,id',
            'destacado' => 'nullable|boolean'
        ];

        $validar = Validator::make($request->all(), $reglas);
        if ($validar->fails()) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $validar->errors()
            ], 422);
        }

        DB::beginTransaction();
        try {
            $restaurante = Restaurante::find($id);
            if (!$restaurante) {
                return response()->json(['message' => 'Restaurante no encontrado.'], 404);
            }
            $restaurante->update($request->except('opciones_nutritivas'));
            $restaurante->opcionesNutritivas()->sync($request->input('opciones_nutritivas', []));
            DB::commit();
            return response()->json([
                'message' => 'Restaurante actualizado exitosamente.',
                'restaurante' => $restaurante
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Error al actualizar restaurante'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
