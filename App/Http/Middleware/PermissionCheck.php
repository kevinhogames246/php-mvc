<?php

namespace App\Http\Middleware;

use \App\Session\Admin\Login as SessionAdminLogin;
use \App\Http\Response;

class PermissionCheck {

    /**
     * Metodo responsavel por carregar o arquivo de mapeamento de permissoes
     * @return array
     */
    private function getPermissionMap() {
        $path = dirname(dirname(dirname(__DIR__))) . DIRECTORY_SEPARATOR . 'rotas_permissoes.json';
        if (!file_exists($path)) {
            // Se o arquivo de permissões não existir, negamos o acesso por segurança.
            return null;
        }
        return json_decode(file_get_contents($path), true);
    }

    /**
     * Metodo responsavel por verificar se a funcao do usuario tem acesso a rota
     * @param string $route Caminho da rota (Ex: /admin/usuarios)
     * @param string $userRole Funcao do usuario logado (Ex: admin)
     * @param array $permissionMap Mapeamento de rotas e permissoes
     * @return bool
     */
    private function checkAccess($route, $userRole, $permissionMap) {
        
        // Remove a query string (ex: ?page=1) para casar com a rota estática
        $cleanRoute = explode('?', $route)[0];
        
        // Se a rota não estiver listada no JSON, assumimos que ela está livre,
        // mas APENAS se o require-admin-login já tiver garantido o login.
        if (!isset($permissionMap[$cleanRoute])) {
            return true;
        }

        $requiredRoles = $permissionMap[$cleanRoute]['permissoes_necessarias'] ?? [];

        // Verifica se a role do usuário está na lista de permissoes necessarias
        return in_array($userRole, $requiredRoles);
    }

    /**
     * Metodo responsavel por executar o middleware
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next) {
        
        // 1. Obtém a função do usuário logado
        $userRole = SessionAdminLogin::getUserRole();
        
        // 2. Obtém a rota atual
        $currentRoute = $request->getUri();
        
        // 3. Carrega o mapeamento de permissoes
        $permissionMap = $this->getPermissionMap();

        echo '<pre>';
        print_r($currentRoute);
        echo '</pre>';exit;

        if ($permissionMap === null) {
            // Falha grave: arquivo de permissoes ausente.
            return new Response(500, '{"error":"Configuration Error: Permission map not found."}', 'application/json');
        }

        // 4. Verifica a permissão
        if ($this->checkAccess($currentRoute, $userRole, $permissionMap)) {
            // Permissão OK, continua para o próximo Middleware/Controller
            return $next($request);
        }

        // 5. Permissão Negada (A autorização falhou)
        $requiredRoles = $permissionMap[$currentRoute]['permissoes_necessarias'] ?? [];
        
        // Você pode redirecionar para uma página de erro 403 ou retornar JSON
        return new Response(403, 
            '{"error":"Forbidden","message":"Permission Denied. Role: ' . $userRole . '. Required: ' . implode(', ', $requiredRoles) . '"}', 
            'application/json'
        );
    }
}