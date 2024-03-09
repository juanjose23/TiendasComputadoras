<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;
    public function modelos()
    {
        return $this->belongsTo('App\Models\Modelos');
    }
    public function subcategorias()
    {
        return $this->belongsTo('App\Models\Subcategorias');
    }
}
