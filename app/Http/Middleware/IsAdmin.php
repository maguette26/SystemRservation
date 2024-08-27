<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_admin) { // Vérifie si l'utilisateur est connecté et est admin
            return $next($request);
        }

        // Redirige l'utilisateur s'il n'est pas admin
        return redirect('/')->with('error', "Vous n'avez pas accès à cette section.");
    }
}
