<?php

namespace App\Http\Middleware;

use \App\Session\Common\Login as SessionCommonLogin;

class RequireCommonLogin{

    /**
     * Metodo responsavel por executar o middleware
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){

        if(SessionCommonLogin::isLogged()){
            $request->getRouter()->redirect('/login');
        }

        return $next($request);
    }
}