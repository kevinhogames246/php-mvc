<?php

use \App\Http\Response;
use \App\Controller\Pages;
use \App\Controller\Common;

$obRouter->get('/', [
    // 'role' => ['admin', 'atualizador'],
    function(){
        return new Response(202, Pages\Page::getPage('Ola mund'));
    }
]);

// ROTA DE LOGIN (EXIBIÇÃO)
$obRouter->get('/login', [
    function($request){
        return new Response(200, Common\Login::getLogin($request));
    }
]);

// ROTA DE LOGIN (POST)
$obRouter->post('/login', [
    function($request){
        return new Response(200, Common\Login::setLogin($request));
    }
]);

// ROTA DE SELEÇÃO DE CONTEXTO (HUB)
$obRouter->get('/contexto', [
    function($request){
        return new Response(200, Common\Contexto::getContexto($request));
    }
]);