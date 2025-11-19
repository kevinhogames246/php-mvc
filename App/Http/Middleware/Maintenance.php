<?php

namespace App\Http\Middleware;

// use App\Http\Request;
// use App\Http\Response;

class Maintenance{

    /**
     * Metodo responsavel por executar o middleware
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){
        if (getenv('MAINTENANCE') == 'true') {
            throw new \Exception("Página em manutenção. Tente novamente mais tarde.", 200);
            
        }
        return $next($request);
    }
}