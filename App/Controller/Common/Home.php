<?php

namespace App\Controller\Common;

use \App\Utils\View;

class Home extends Page {
    /**
     * Retorna o conteúdo da Home de um módulo
     */
    public static function getHome($request) {
        // Aqui você pode personalizar a Home baseado em qual URL ele acessou
        // $uri = $request->getRouter()->getUri();
        
        // $content = View::render('pages/home', [
        //     'modulo' => strtoupper(str_replace('/', '', $uri))
        // ]);

        // return parent::getPage('Home Módulo', $content);
        return 'home';
    }
}