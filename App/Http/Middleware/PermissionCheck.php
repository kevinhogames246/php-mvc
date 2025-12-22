<?php

namespace App\Http\Middleware;

use \App\Session\Common\Login as SessionLogin;
use \App\Http\Response;
use \App\Utils\View;
use \App\Controller\Common\Page; // Mantenha ou ajuste para Common\Page conforme sua necessidade

class PermissionCheck {

    /**
     * Metodo responsavel por executar o middleware
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, $next) {
        // 1. Obtém a role do usuário logado na sessão (Common)
        $userRoles = SessionLogin::getUserRoles();
        
        // 2. Obtém os dados da rota atual diretamente do Router
        // O Router deve ter o método getCurrentRoute() que retorna o array $params
        $route = $request->getRouter()->getCurrentRoute();
        
        // 3. Verifica se a rota possui restrição de 'role' definida
        $allowedRoles = $route['role'] ?? [];


        // 4. Identifica se é uma requisição de API pelo prefixo da URI
        $currentUri = $request->getRouter()->getCurrentUri();
        $isApi = str_contains($currentUri, '/api');

        // VALIDAÇÃO A: Rota pública (se não houver 'role' definida na rota, permite acesso)
        if (empty($allowedRoles)) {
            return $next($request);
        }

        // VALIDAÇÃO B: Verificação de Login (401)
        if ($userRoles === null) {
            return $this->getErrorResponse(401, "Não Autorizado", "Você precisa estar logado para acessar esta área.", $isApi);
        }

        // Verifica se PELO MENOS UMA das roles do usuário está no array da rota
        // array_intersect retorna os valores comuns entre os dois arrays
        if (!empty(array_intersect($userRoles, $allowedRoles))) {
            return $next($request);
        }

        // Se chegou aqui, o usuário está logado mas não tem a role necessária
        return $this->getErrorResponse(403, "Acesso Proibido", "Suaa funções não tem permissão para acessar este módulo.", $isApi);
    }

    /**
     * Metodo responsavel por retornar o erro formatado (JSON ou HTML)
     * @param int $code
     * @param string $error
     * @param string $message
     * @param bool $isApi
     * @return Response
     */
    private function getErrorResponse($code, $error, $message, $isApi) {
        
        // Em caso de erro de permissão ou não autorizado, opcionalmente desloga
        // SessionLogin::logout(); 

        if ($isApi) {
            $body = json_encode([
                'status'  => 'erro',
                'code'    => $code,
                'error'   => $error,
                'message' => $message
            ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            
            return new Response($code, $body, 'application/json');
        }

        // Retorna a página de erro usando o Controller de Page padrão
        // Ajuste o nome da classe Page se você mudou de Admin para Common
        return new Response($code, Page::getError($code, $error, $message));
    }
}