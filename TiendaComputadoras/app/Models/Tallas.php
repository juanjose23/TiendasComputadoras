<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tallas extends Model
{
    use HasFactory;
    public function tallasproductos()
    {
        return $this->hasMany('App\Models\Tallas');
    }
}

