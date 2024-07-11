<?php

namespace App\Livewire;

use Livewire\Component;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Illuminate\Support\Facades\Auth;

class Contador extends Component
{
    public function render()
    {
        $sessionId = session()->getId();
        $cartItems = Cart::session($sessionId)->getContent();
        $totalItems = $cartItems->count();
        return view('livewire.contador', compact('totalItems'));
    }
}
