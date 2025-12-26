<?php

use \App\Http\Response;
use \App\Controller\Pages;
use \App\Controller\Common\Login;

$obRouter->get('/', [
    function(){
        return new Response(202, Pages\Page::getPage('Ola mund'));
    }
]);

// ROTA DE LOGIN (EXIBIÇÃO)
$obRouter->get('/login', [
    function($request){
        return new Response(200, Login::getLogin($request));
    }
]);

// ROTA DE LOGIN (POST)
$obRouter->post('/login', [
    function($request){
        return new Response(200, Login::setLogin($request));
    }
]);