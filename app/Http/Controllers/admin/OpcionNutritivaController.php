<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\OpcionNutritiva;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class OpcionNutritivaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $opciones = OpcionNutritiva::all();
        return view('admin.opciones_nutritivas.index', ['opciones' => $opciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.opciones_nutritivas.create');
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
            $opciones = new \App\Models\OpcionNutritiva();
            $opciones->nombre = $request->input('nombre');
            $opciones->save();

            return response()->json([
                'message' => 'Categoría creada exitosamente.',
                'opciones' => $opciones
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
        $opciones = OpcionNutritiva::find($id);
        if (!$opciones) {
            abort(404, 'Categoría no encontrada');
        }
        return view('admin.opciones_nutritivas.edit', compact('opciones'));
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
            $opciones = OpcionNutritiva::find($id);
            if (!$opciones) {
                return response()->json([
                    'message' => 'Categoría no encontrada.'
                ], 404);
            }
            $opciones->nombre = $request->input('nombre');
            $opciones->save();

            return response()->json([
                'message' => 'Categoría actualizada exitosamente.',
                'opciones' => $opciones
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
        //
        DB::beginTransaction();
        try {
            $opciones = OpcionNutritiva::find($id);
            if (!$opciones) {
                return response()->json([
                    'message' => 'Requisito no existe'
                ], 404);
            }
            $opciones->delete();
            DB::commit();
            $data = [
                'message' => 'Categoría eliminada de la base de datos.'
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
