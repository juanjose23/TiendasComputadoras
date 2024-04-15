<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cortes extends Model
{
    use HasFactory;
    public function cortesproductos()
    {
        return $this->hasMany('App\Models\Cortes_productos');
    }
}
