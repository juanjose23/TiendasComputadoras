<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tallas extends Model
{
    use HasFactory;
    public function tallasproductos()
    {
        return $this->hasMany('App\Models\Tallas_productos');
    }
    
}

