<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImagenRestaurante extends Model
{
    use SoftDeletes;
    protected $table = 'imagenes_restaurante';
    protected $fillable = [
        'restaurante_id',
        'url',
    ];

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }
}
