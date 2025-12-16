<?php

use \App\Http\Response;
use \App\Controller\Admin;

$obRouter->get('/admin', [
    'middlewares' => [
        'permission-check'
    ],
    function(){
        // return new Response(202, "admin");
        return new Response(202, Admin\Login::getPage("usuario logado", "teste"));
    }
]);

// rota para login
$obRouter->get('/admin/login', [
    'middlewares' => [
                'required-admin-logout'
    ],
    function($request){
        return new Response(202, Admin\Login::getLogin($request));
    }
]);

// rota para login (post)
$obRouter->post('/admin/login', [
    function($request){
        return new Response(202, Admin\Login::setLogin($request));
    }
]);

//rota logout
$obRouter->get('/admin/logout', [
    function($request){
        return new Response(202, Admin\Login::setLogout($request));
    }
]);