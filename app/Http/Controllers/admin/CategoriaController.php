<?php

namespace App\Http\Controllers\admin;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categorias = Categoria::all();
        return view('admin.categorias.index', ["categorias" => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Reglas de validación para Categoría
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
            $categoria = new \App\Models\Categoria();
            $categoria->nombre = $request->input('nombre');
            $categoria->save();

            return response()->json([
                'message' => 'Categoría creada exitosamente.',
                'categoria' => $categoria
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
        $categoria = Categoria::find($id);
        if (!$categoria) {
            abort(404, 'Categoría no encontrada');
        }
        return view('admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Reglas de validación para Categoría
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
            $categorias = Categoria::find($id);
            if (!$categorias) {
                return response()->json([
                    'message' => 'Categoría no encontrada.'
                ], 404);
            }
            $categorias->nombre = $request->input('nombre');
            $categorias->save();

            return response()->json([
                'message' => 'Categoría actualizada exitosamente.',
                'categoria' => $categorias
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
            $categoria = Categoria::find($id);
            if (!$categoria) {
                return response()->json([
                    'message' => 'Requisito no existe'
                ], 404);
            }
            $categoria->delete();
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
