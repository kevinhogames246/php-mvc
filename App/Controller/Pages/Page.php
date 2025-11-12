<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page{

    private static function getHeader(){
        return View::render('pages/header', ['number' => 1]);
    }

    public static function getPage($conteudoTicket){
        return View::render('pages/page', [
                'header'         => self::getHeader(),
                'tickets' =>  $conteudoTicket
            ]
        );
    }
}