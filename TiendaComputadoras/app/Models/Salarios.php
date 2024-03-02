<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salarios extends Model
{
    use HasFactory;

    public function empleados()
    {
        return $this->belongsTo('App\Models\Empleados');
    
    }
}
