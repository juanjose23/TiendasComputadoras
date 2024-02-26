<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    use HasFactory;
    public function departamentos()
    {
        return $this->belongsTo('App\Models\Departamentos');
    }
    public function direcciones()
    {
        return $this->hasMany(Direcciones::class);
    }

}
