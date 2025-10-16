<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckModuleActiveb
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $moduleName): Response
    {
        $user = Auth::user();

        // si le module est desactive 
        

        // recuperer l'enregistrement dans la table `user_module` pour l'utilisateur et le module
        $moduleUser = $user->modules()
            ->where('module_name', $moduleName)
            ->first();

        // Vérifie si le module existe et si la colonne est 'active'
        if ($moduleUser && $moduleUser->pivot->active) {
             // Si le module est active, continuer
            return $next($request); 
        }else{
            return response()->json([
                'error' => 'Module inactive. Please activate this module to use it.',
            ], 403);
        }
        // sinon

    }


    //  protected function isModuleActivate()
    //         {
              
    //         }
}
