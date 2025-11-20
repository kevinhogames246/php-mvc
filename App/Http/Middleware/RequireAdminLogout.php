<?php

namespace App\Http\Middleware;

use \App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogout{

    /**
     * Metodo responsavel por executar o middleware
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next){
        if(SessionAdminLogin::isLogged()){
            $request->getRouter()->redirect('/admin');
        }
        die("Esta logado");

        if (getenv('MAINTENANCE') == 'true') {
            throw new \Exception("Página em manutenção. Tente novamente mais tarde.", 200);
            
        }
        return $next($request);
    }
}