<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona_Juridicas extends Model
{
    use HasFactory;
    protected $table = 'persona_juridicas';
    public function persona()
    {
        return $this->belongsTo('App\Models\Personas');
    }
}
