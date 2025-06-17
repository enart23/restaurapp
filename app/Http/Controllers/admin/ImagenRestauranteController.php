<?php

namespace App\Http\Controllers\admin;

use App\Models\ImagenRestaurante;
use App\Models\Restaurante;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenRestauranteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $imagenes = ImagenRestaurante::with('restaurante')->get();
        return view('admin.imagenes_restaurantes.index', compact('imagenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.imagenes_restaurantes.create', [
            'restaurantes' => Restaurante::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
        'restaurante_id' => 'required|exists:restaurantes,id',
        'imagen' => 'required|image|max:2048'
    ]);

    if ($request->hasFile('imagen')) {
        $path = $request->file('imagen')->store('restaurantes', 'public');
        $imagen = ImagenRestaurante::create([
            'restaurante_id' => $request->restaurante_id,
            'url' => $path
        ]);
        return response()->json([
            'message' => 'Imagen subida correctamente.',
            'imagen' => $imagen
        ], 201);
    } else {
        return response()->json([
            'message' => 'No se recibió archivo.'
        ], 422);
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
        $imagen = ImagenRestaurante::find($id);
    if (!$imagen) {
        return response()->json(['message' => 'Imagen no encontrada.'], 404);
    }
    Storage::disk('public')->delete($imagen->ruta);
    $imagen->delete();
    return response()->json(['message' => 'Imagen eliminada correctamente.']);
    }
}
