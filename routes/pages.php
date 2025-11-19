<?php

use \App\Http\Response;
use \App\Controller\Pages;

$obRouter->get('/', [
    function(){
        return new Response(202, Pages\Page::getPage('Ola mund'));
    }
]);

// $obRouter->get('/login', [
//     function(){
//         return new Response(202, Pages\Page::Login());
//     }
// ]);

$obRouter->get('/tickets', [
    function($request){
        return new Response(202, Pages\Tickets::Tickets($request));
    }
]);

$obRouter->get('/ticket/details/{idTicket}', [
    function($idTicket){
        // return new Response(202, Pages\Page::getPage('Ticket '. $idTicket . ' - ' . $acao));
        return new Response(202, Pages\Tickets::TicketFormular($idTicket));
    }
]);

$obRouter->post('/ticket/details/{idTicket}', [
    function($idTicket, $request){
        // return new Response(202, Pages\Page::getPage('Ticket '. $idTicket . ' - ' . $acao));
        return new Response(202, Pages\Tickets::TicketFormular($idTicket, $request));
    }
]);

$obRouter->get('/ticket/cadastrar', [
    function(): Response{
        // return new Response(202, Pages\Page::getPage('Ticket '. $idTicket . ' - ' . $acao));
        return new Response(202, Pages\Tickets::TicketFormular());
    }
]);

$obRouter->post('/ticket/cadastrar', [
    function($request){
        // return new Response(202, Pages\Page::getPage('Ticket '. $idTicket . ' - ' . $acao));
        return new Response(202, Pages\Tickets::insertTicket($request));
    }
]);