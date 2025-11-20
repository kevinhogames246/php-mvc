<?php

use \App\Http\Response;
use \App\Controller\Admin;

$obRouter->get('/admin', [
    function(){
        return new Response(202, "admin");
    }
]);

$obRouter->get('/admin/login', [
    'middlewares' => [
            // $middlewares => [
                'required-admin-logout'
            // ]
    ],
    function($request){
        return new Response(202, Admin\Login::getLogin($request));
    }
]);

$obRouter->post('/admin/login', [
    function($request){
        return new Response(202, Admin\Login::setLogin($request));
    }
]);