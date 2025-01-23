<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AutoLoginAsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        // Check of de gebruiker al ingelogd is, anders log in als admin.
        if (Auth::guest()) {
            // Zoek de gebruiker met de 'admin' rol
            $user = User::whereHas('roles', function ($query) {
                $query->where('name', 'admin');  // Zoek naar de 'admin' rol
            })->first();

            // Als er een admin-gebruiker is, log deze dan in
            if ($user) {
                Auth::login($user);
            }
        }
        return $next($request);
    }
}