<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\Detalles_Lotes;
use App\Models\Lotes;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function index()
    {
        // Obtener el ID de la sesión actual
        $sessionId = session()->getId();

        // Obtener los ítems del carrito basado en la sesión actual
        $cartItems = Cart::session($sessionId)->getContent();

        // Retornar la vista 'cart.index' con los ítems del carrito
        return view('cart.index', compact('cartItems'));
    }


    public function add(Request $request)
    {
        // Obtener el ID de la sesión
        $sessionId = session()->getId();

        // Obtener los datos del producto del request
        $productId = $request->input('id');
        $quantity = $request->input('quantity', 1);
        $precio = $request->input('precio', 1);

        // Verificar si hay suficiente inventario disponible
        if (!$this->InventarioDisponible($productId, $quantity)) {
            return redirect()->back()->with('error', 'No hay suficiente inventario disponible para este producto.');
        }

        // Crear el array del producto con sus atributos
        $product = [
            'id' => $productId,
            'name' => $request->input('name'),
            'quantity' => $quantity,
            'price' => $precio,
            'attributes' => [
                'image_url' => $request->input('image_url'),
                'corte' => $request->input('corte'),
                'talla' => $request->input('talla'),
                'color' => $request->input('color'),
                'genero' => $request->input('genero'),

            ],
        ];

        // Agregar el producto al carrito usando el ID de la sesión
        Cart::session($sessionId)->add($product);

        // Redireccionar de vuelta con un mensaje de éxito
        return redirect()->back()->with('success', 'Material agregado a la cesta de reciclaje correctamente');
    }
    public function update(Request $request, $itemId)
    {
        // Obtener el ID de la sesión
        $sessionId = session()->getId();

        // Obtener el artículo antes de eliminarlo
        $item = Cart::session($sessionId)->get($itemId);

        // Verificar si el artículo existe
        if (!$item) {
            return redirect()->back()->with('error', 'Artículo no encontrado en el carrito.');
        }

        // Calcular el precio basado en los puntos acumulados u otros factores si es necesario
        $precio = $request->input('precio', $item->price);

        // Verificar si hay suficiente inventario disponible
        if (!$this->InventarioDisponible($item->id, $request->input('quantity'))) {
            return redirect()->back()->with('error', 'No hay suficiente inventario disponible.');
        }

        // Eliminar el artículo del carrito
        Cart::session($sessionId)->remove($itemId);

        // Crear el array del producto con sus atributos personalizados y la nueva cantidad
        $product = [
            'id' => $item->id,
            'name' => $item->name,
            'quantity' => $request->input('quantity', 1),
            'price' => $precio,
            'attributes' => [
                'image_url' => $item->attributes->image_url,
                'corte' => $item->attributes->corte,
                'talla' => $item->attributes->talla,
                'color' => $item->attributes->color,
                'genero' => $item->attributes->genero,
            ],
        ];

        // Agregar el producto nuevamente al carrito usando el ID de la sesión
        Cart::session($sessionId)->add($product);

        return redirect()->route('cart.index')->with('success', 'Cantidad del producto actualizada correctamente');
    }


    public function remove($itemId)
    {
        Cart::session(Auth::id())->remove($itemId);
        return redirect()->route('cart.index')->with('success', 'Producto eliminado del carrito');
    }

    public function clear()
    {
        Cart::session(Auth::id())->clear();
        return redirect()->route('cart.index')->with('success', 'Carrito vaciado');
    }
    public function InventarioDisponible($productosdetalles_id, $cantidad)
    {
        // Obtener el inventario actual del producto en la tabla detalles_lotes
        $productoDetalle = DB::table('detalles_lotes')->where('productosdetalles_id', $productosdetalles_id)->first();
        if (!$productoDetalle) {
            // Producto no encontrado en detalles_lotes
            return false;
        }

        $inventarioActual = $productoDetalle->cantidad;

        // Recorrer todos los carritos y sumar las cantidades reservadas de este producto
        $totalReservado = 0;
        $carritos = DB::table('sessions')->get(); // Obtener todas las sesiones activas

        foreach ($carritos as $carrito) {
            $sessionId = $carrito->id;
            $cartItems = Cart::session($sessionId)->getContent();
            foreach ($cartItems as $item) {
                if ($item->id == $productosdetalles_id) {
                    $totalReservado += $item->quantity;
                }
            }
        }

        // Calcular el inventario disponible
        $inventarioDisponible = $inventarioActual - $totalReservado;

        // Verificar si hay suficiente inventario disponible
        return $inventarioDisponible >= $cantidad;
    }
}
