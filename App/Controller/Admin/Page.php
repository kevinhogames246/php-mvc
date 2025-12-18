<?php

namespace App\Controller\Admin;

use \App\Utils\View;
use \App\DotEnv\Environment;

class Page{

    /**
     * Metodo responsavel por retornar o contúdo (view) da estrutura genérica de página do painel
     * @param string $title
     * @param string $content
     * @return string
     */
    public static function getPage($title, $content){
        return View::render('admin/page', [
                'title'          => $title,
                'content'         => $content
            ]
        );
    }

    public static function getError($code, $error, $message) {
        return self::getPage(
            'Erro - '.$error,
             View::render('utils/error', [
                'code'     => $code,
                'error'    => $error,
                'message'  => $message,
                'url_home' => getenv('URL') // Ajuste conforme sua rota inicial
            ])
        );
    }
}