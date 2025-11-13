<?php

use \App\Http\Response;
use \App\Controller\Pages;

$obRouter->get('/', [
    function(){
        return new Response(202, Pages\Page::getPage('Ola mund'));
    }
]);

$obRouter->get('/tickets', [
    function(){
        return new Response(202, Pages\Tickets::Tickets());
    }
]);

$obRouter->get('/ticket/{idTicket}', [
    function($idTicket){
        // return new Response(202, Pages\Page::getPage('Ticket '. $idTicket . ' - ' . $acao));
        return new Response(202, Pages\Tickets::TicketFormular($idTicket));
    }
]);

$obRouter->get('/ticket/cadastrar', [
    function($request){
        // return new Response(202, Pages\Page::getPage('Ticket '. $idTicket . ' - ' . $acao));
        return new Response(202, Pages\Tickets::TicketFormular(['idTicket' => '']));
    }
]);

$obRouter->post('/ticket/cadastrar', [
    function($request){
        // return new Response(202, Pages\Page::getPage('Ticket '. $idTicket . ' - ' . $acao));
        return new Response(202, Pages\Tickets::insertTicket($request));
    }
]);