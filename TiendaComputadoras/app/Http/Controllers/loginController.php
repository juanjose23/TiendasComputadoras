<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Fortify\Rules\PasswordRule;

class loginController extends Controller
{
    //
    /**
     * Show the two factor authentication setup form.
     *
     * @return \Illuminate\View\View
     */
    public function dospasos()
    {
        return view('auth.enable-two-factor-auth');
    }

    /**
     * Enable two factor authentication for the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->user()->enableTwoFactorAuth();

        return redirect('/login')->with('status', 'Two factor authentication has been enabled.');
    }
}
