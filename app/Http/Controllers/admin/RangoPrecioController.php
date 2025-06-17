<?php

namespace App\Http\Controllers\admin;

use App\Models\RangoPrecio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class RangoPrecioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $rangos = RangoPrecio::all();
        return view('admin.rango_precio.index', ['rangos' => $rangos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.rango_precio.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $reglas = [
            'nombre' => 'required|string|max:60',
        ];

        $validar = Validator::make($request->all(), $reglas);
        if ($validar->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validar->errors()
            ];
            return response()->json($data, 422);
        }

        try {
            $rangos = new \App\Models\RangoPrecio();
            $rangos->nombre = $request->input('nombre');
            $rangos->save();

            return response()->json([
                'message' => 'Categoría creada exitosamente.',
                'rangos' => $rangos
            ], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Error al crear la categoría'
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
        $rangos = RangoPrecio::find($id);
        if (!$rangos) {
            abort(404, 'Categoría no encontrada');
        }
        return view('admin.rango_precio.edit', compact('rangos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $reglas = [
            'nombre' => 'required|string|max:60',
        ];

        $validar = Validator::make($request->all(), $reglas);
        if ($validar->fails()) {
            $data = [
                'message' => 'Error de validación',
                'errors' => $validar->errors()
            ];
            return response()->json($data, 422);
        }

        try {
            $rangos = RangoPrecio::find($id);
            if (!$rangos) {
                return response()->json([
                    'message' => 'Nivel de Higiene no encontrado.'
                ], 404);
            }
            $rangos->nombre = $request->input('nombre');
            $rangos->save();

            return response()->json([
                'message' => 'Categoría actualizada exitosamente.',
                'rangos' => $rangos
            ], 201);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Error al actualizar la categoría'
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $rangos = RangoPrecio::find($id);
            if (!$rangos) {
                return response()->json([
                    'message' => 'Requisito no existe'
                ], 404);
            }
            $rangos->delete();
            DB::commit();
            $data = [
                'message' => 'Nivel de Higiene eliminado de la base de datos.'
            ];
            return response()->json($data, 200);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json([
                'message' => 'Error al eliminar la categoría',
            ], 500);
        }
    }
}
