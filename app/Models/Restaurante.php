<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Restaurante extends Model
{
    use SoftDeletes;
    // Permite asignación masiva
    protected $fillable = [
        'nombre',
        'descripcion',
        'direccion',
        'telefono',
        'email',
        'sitio_web',
        'categoria_id',
        'nivel_higiene_id',
        'rangos_precio_id',
        'destacado',
        // agrega aquí cualquier otro campo que tenga tu tabla restaurantes
    ];

    // Relaciones
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function nivelHigiene()
    {
        return $this->belongsTo(NivelHigiene::class, 'nivel_higiene_id');
    }

    public function rangoPrecio()
    {
        return $this->belongsTo(RangoPrecio::class, 'rangos_precio_id');
    }

    public function opcionesNutritivas()
    {
        return $this->belongsToMany(OpcionNutritiva::class, 'restaurante_opciones_nutritivas', 'restaurante_id', 'opcion_nutritiva_id');
    }


    public function imagenes()
    {
        return $this->hasMany(ImagenRestaurante::class, 'restaurante_id');
    }
    public function imagenDestacada()
    {
        return $this->hasOne(ImagenRestaurante::class)->where('estado', 1);
    }
}
