<?php

namespace App\Http\Controllers\Stripe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\DB;
class StripeController extends Controller
{
    //
      //
      public function stripe(Request $request)
      {
          $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
      
          $sessionId = session()->getId();
      
          // Obtener los ítems del carrito basado en la sesión actual
          $cartItems = Cart::session($sessionId)->getContent();
      
          // Preparar los ítems del carrito para Stripe
          $lineItems = [];
          foreach ($cartItems as $item) {
              $lineItems[] = [
                  'price_data' => [
                      'currency' => 'NIO', 
                      'product_data' => [
                          'name' => $item->name,
                         'description' => 'Color: ' . $item->attributes->color . ', Corte: ' . $item->attributes->corte . ', Talla: ' . $item->attributes->talla,

                      ],
                      'unit_amount' => $item->price * 100, 
                  ],
                  'quantity' => $item->quantity,
              ];
          }
      
          // Crear la sesión de checkout en Stripe
          $response = $stripe->checkout->sessions->create([
              'payment_method_types' => ['card'],
              'line_items' => $lineItems,
              'mode' => 'payment',
              'success_url' => route('success').'?session_id={CHECKOUT_SESSION_ID}',
              'cancel_url' => route('cancel'),
          ]);
      
          // Redirigir al cliente a la página de pago de Stripe
          if (isset($response->id) && $response->id != '') {
              return redirect($response->url);
          } else {
              return redirect()->route('cancel');
          }
      }
      
      public function success(Request $request)
      {
          if(isset($request->session_id)) {
  
              $stripe = new \Stripe\StripeClient(config('stripe.stripe_sk'));
              $response = $stripe->checkout->sessions->retrieve($request->session_id);
              $sessionId = session()->getId();

              // Obtener los ítems del carrito basado en la sesión actual
              Cart::session($sessionId)->clear();
      
              return redirect()->route('inicios')->with('success','Se ha completado la compra');
          } else {
              return redirect()->route('cancel');
          }
      }
  
      public function cancel()
      {
         
          return redirect()->route('inicios')->with('success','Se ha cancelado la compra');
      }
}
