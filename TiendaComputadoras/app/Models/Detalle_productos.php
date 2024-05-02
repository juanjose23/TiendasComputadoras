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


    public function tallasproductos()
    {
        return $this->BelongsTo('App\Models\Tallas_productos');
    }

    public function coloresproductos()
    {
        return $this->BelongsTo('App\Models\Colores_productos');
    }
   
    public function cortesproductos()
    {
        return $this->BelongsTo('App\Models\Cortes_Productos');
    }

    public function generos()
    {
        return $this->belongsTo('App\Models\Genero','generos_id');
    }

     /**
     * Busca el ID del producto asociado al ID de color.
     * 
     * @param int $id El ID del color del producto.
     * @return int|null El ID del producto o null si no se encuentra.
     */
    public static function BuscarIdproducto($id)
    {
        $Producto = Detalle_productos::find($id);
        if ($Producto) {
            return $Producto->productos_id;
        }
        return null;
    }
}
