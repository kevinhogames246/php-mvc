<?php

use \App\Http\Response;
use \App\Controller\Pages;
use \App\Controller\Common;

$obRouter->get('/', [
    // 'role' => ['admin', 'atualizador'],
    function () {
        return new Response(202, Pages\Page::getPage('Ola mund'));
    }
]);

// ROTA DE LOGIN (EXIBIÇÃO)
$obRouter->get('/login', [
    function ($request) {
        return new Response(200, Common\Login::getLogin($request));
    }
]);

// ROTA DE LOGIN (POST)
$obRouter->post('/login', [
    function ($request) {
        return new Response(200, Common\Login::setLogin($request));
    }
]);

// ROTA DE LOGIN (EXIBIÇÃO)
$obRouter->get('/logout', [
    function ($request) {
        return new Response(200, Common\Login::setLogout($request));
    }
]);


// ROTA DE SELEÇÃO DE CONTEXTO (HUB)
$obRouter->get('/contexto', [
    'middlewares' => [
        'required-common-logout' // Garante que está logado
    ],
    function ($request) {
        return new Response(200, Common\Contexto::getContexto($request));
    }
]);



// MÓDULO ATUALIZADOR
$obRouter->get('/atualizador', [
    'middlewares' => [
        'required-common-logout'// , // Garante que está logado
        // 'permission-check'      // Garante que tem a role 'atualizador'
    ],
    'role' => ['atualizador'],  // Esta é a chave que o Middleware lê
    function ($request) {
        return new \App\Http\Response(200, Common\Home::getHome($request));
    }
]);
