<?php

use \App\Http\Response;
use \App\Controller\Pages;

$obRouter->get('/', [
    function(){
        return new Response(202, 'Home -> tickets');
    }
]);

$obRouter->get('/tickets', [
    function(){
        return new Response(202, Pages\Tickets::Tickets());
    }
]);

$obRouter->get('/ticket/{idTicket}/{acao}', [
    function($idTicket, $acao){
        return new Response(202, 'Ticket '. $idTicket . ' - ' . $acao);
    }
]);