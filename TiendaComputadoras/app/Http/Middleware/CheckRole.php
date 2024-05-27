<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CheckRole
{
    public function handle($request, Closure $next, $privilegeId)
    {
        $UserId = Auth::id();
        if (!$UserId) {
            return redirect()->route('login');
        }
        
        if (!User::hasPrivilege($UserId, $privilegeId)) {
            return redirect()->route('error403');
        }

        return $next($request);
    }
}
