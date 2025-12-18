<?php

namespace App\Http\Middleware;

use \App\Session\Admin\Login as SessionAdminLogin;
use \App\Http\Response;
use \App\DotEnv\Environment;
use \App\Utils\View;
use \App\Controller\Admin\Page;

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
        
        // Se a rota não estiver listada no JSON, assumimos que ela está livre,
        // mas APENAS se o require-admin-login já tiver garantido o login.
        if (!isset($permissionMap[$route])) {
            return true;
        }

        $requiredRoles = $permissionMap[$route]['permissoes_necessarias'] ?? [];

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
        $userRole = SessionAdminLogin::getUserRole();
        $currentRoute = $request->getRouter()->getCurrentUri();
        $permissionMap = $this->getPermissionMap();
        $isApi = str_contains($currentRoute, '/api');

        // 1. Verificação de Login (401)
        if ($userRole === null) {
            return $this->getErrorResponse(401, "Não Autorizado", "Você precisa estar logado para acessar esta área.", $isApi);
        }

        // 2. Verificação de Arquivo de Configuração (500)
        if ($permissionMap === null) {
            return $this->getErrorResponse(500, "Erro Interno", "Configuração de permissões não encontrada.", $isApi);
        }
        
        // 3. Verificação de Acesso (403)
        if ($this->checkAccess($currentRoute, $userRole, $permissionMap)) {
            return $next($request);
        }

        return $this->getErrorResponse(403, "Acesso Proibido", "Sua função ($userRole) não tem permissão para acessar esta página.", $isApi);
    }

    /**
     * Retorna erro em JSON para API ou HTML para Web
     */
    private function getErrorResponse($code, $error, $message, $isApi) {

        SessionAdminLogin::logout();

        if ($isApi) {
            $body = json_encode([
                'status'  => 'erro',
                'code'    => $code,
                'error'   => $error,
                'message' => $message
            ], JSON_UNESCAPED_UNICODE);
            
            return new Response($code, $body, 'application/json');
        }

        // Retorna a página completa usando o Controller Admin\Page para manter o layout (menu, css, etc)
        // Se o seu Page::getPage exigir um Request, você pode passar ou simplificar
        return new Response($code, Page::getError($code,$error,$message));
    }
}