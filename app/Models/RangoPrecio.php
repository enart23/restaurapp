<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RangoPrecio extends Model
{
    use SoftDeletes;
    protected $table = 'rangos_precio';
    protected $fillable = [
        'nombre',
    ];

    public function restaurantes()
    {
        return $this->hasMany(Restaurante::class);
    }
}
