<?php

namespace App\Controller\Common;


use \App\Utils\View;
use \App\Http\Request;
use \App\Session\Common\Login as SessionLogin;

class Contexto extends Page
{

    /**
     * Metodo responsavel por gerar a tela de contexto
     * @param Request $request
     * @return void
     */
    public static function getContexto($request){

        $roles = SessionLogin::getUserRoles();
        $item = '';
        
        $url = $request->getRouter()->getCurrentRoute();

        echo '<pre>';
        print_r($url);
        echo '</pre>';exit;

        // Gera os botões dinamicamente
        foreach ($roles as $role) {
            $itens .= View::render('pages/contexto/item', [
                'modulo'      => $role,
                'nome_modulo' => ucfirst($role),
                'url'         => $url
            ]);
        }

        // Renderiza o conteúdo final
        $content = View::render('pages/contexto', [
            'itens' => $itens
        ]);

        return parent::getPage('Selecionar Módulo', $content);
    }
}
