<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    protected $table = 'imagenes';
    protected $fillable = ['url', 'public_id'];

    public function imagenable()
    {
        return $this->morphTo();
    }
    
}
