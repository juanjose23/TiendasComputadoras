<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelos extends Model
{
    use HasFactory;
    public function marcas()
    {
        return $this->belongsTo('App\Models\Marcas');
    }
}
