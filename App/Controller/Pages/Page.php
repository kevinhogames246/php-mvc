<?php

namespace App\Controller\Pages;

use \App\Utils\View;

class Page{

    private static function getHeader(){
        return View::render('pages/header', [
            'number'    => rand(0, 100)
        ]);
    }
    private static function getFooter(){
        return View::render('pages/footer', []);
    }

    public static function getPage($content){
        return View::render('pages/page', [
                'header'         => self::getHeader(),
                'content'         => $content,
                'footer'         => self::getFooter()
            ]
        );
    }
}