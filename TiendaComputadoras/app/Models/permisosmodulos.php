<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permisosmodulos extends Model
{
    use HasFactory;
    public function modulos(){
        return $this->belongsTo('App\Models\modulos');
    }
    public function permisosp(){
        return $this->belongsTo('App\Models\permisos');
    }
}
