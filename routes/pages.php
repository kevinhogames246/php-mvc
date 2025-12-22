<?php

use \App\Http\Response;
use \App\Controller\Pages;

$obRouter->get('/', [
    'role' => ['admin', 'atualizador'],
    function(){
        return new Response(202, Pages\Page::getPage('Ola mund'));
    }
]);
