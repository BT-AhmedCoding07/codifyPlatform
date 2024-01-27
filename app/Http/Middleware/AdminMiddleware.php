<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Role;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next): Response
    // {
    //         $user = auth()->user();
    //         $userRole = Role::where("id",$user->roles_id );
    //         if ($userRole->nomRole ="Administrateur") {
    //             return $next($request);
    //         }
    //         else{
    //             // En cas d'erreur, retournez une réponse 403 générique
    //             return response()->json(['message' => 'Accès non autorisé.'], 403);
    //         }

    // }

    public function handle(Request $request, Closure $next): Response
    {

        if (auth()->check() && auth()->user()->roles_id === 1) {

            return $next($request);
        } else {
            return new Response('Vous n\'êtes pas autorisé à accéder à cette page', 403);        }
    }
}
