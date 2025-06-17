<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OpcionNutritiva extends Model
{
    use SoftDeletes;
    protected $table = 'opciones_nutritivas';
    protected $fillable = [
        'nombre',
    ];

    public function restaurantes()
    {
        return $this->belongsToMany(Restaurante::class, 'restaurante_opciones_nutritivas', 'opcion_nutritiva_id', 'restaurante_id');
    }
}
