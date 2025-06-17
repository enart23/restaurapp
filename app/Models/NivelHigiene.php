<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NivelHigiene extends Model
{
    use SoftDeletes;
    protected $table ='niveles_higiene';
    
    protected $fillable = [
        'nombre',
    ];

    public function restaurantes()
    {
        return $this->hasMany(Restaurante::class);
    }
}
