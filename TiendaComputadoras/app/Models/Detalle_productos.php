<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Detalle_productos extends Model
{
    protected $table = 'detallesproductos';
    use HasFactory;

    public function productos()
    {
        return $this->BelongsTo('App\Models\Productos');
    }
}
