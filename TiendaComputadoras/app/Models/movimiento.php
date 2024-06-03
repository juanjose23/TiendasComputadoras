<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimiento extends Model
{
    protected $table = 'movimiento';
    use HasFactory;
    public function lotes()
    {
        return $this->hasMany('App\Models\Lotes');
    }
}
