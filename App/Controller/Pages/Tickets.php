<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Ticket;
// use \App\Db\Database;

class Tickets extends Page{

    public static function TicketsDetails($detall = []){
        // $obTicket = new Ticket();

        // ticketsDetails

        $content = View::render('pages/ticketDetails', $detall);

        return $content;
    }
    

    public static function Tickets(){
        $obTicket = (new Ticket())->getTickets()[0];
        
        // ticketsDetails

        $content = View::render('pages/tickets', [
            'ticketsDetails' => self::TicketsDetails([
                                    'id'        => $obTicket->id,
                                    'veiculo'   => $obTicket->veiculo,
                                    'dtHoraIni' => $obTicket->dtHoraIni,
                                    'dtHoraFim' => $obTicket->dtHoraFim
                                ])
            ]
        );


        return parent::getPage($content);
    }
    public static function TicketFormular($idTicket = null){
        $obTicket = isset($idTicket) ? (new Ticket())->getTickets('id = ' . $idTicket)[0] : new Tickets();

        // ticketsDetails

        $content = View::render('pages/ticketFormular', [
            'id'        => $obTicket->id,
            'veiculo'   => $obTicket->veiculo,
            'dtHoraIni' => $obTicket->dtHoraIni,
            'dtHoraFim' => $obTicket->dtHoraFim
            ]
        );


        return parent::getPage($content);
    }

    public static function insertTicket($request){

        
 

        $postVars = $request->getPostVars();
        
        $obTicket = new Ticket();
        $obTicket->veiculo      = $postVars['veiculo'];
        // $obTicket->dtHoraIni    = $postVars['dtHoraIni'];
        // $obTicket->dtHoraFim    = $postVars['dtHoraFim'];
        $obTicket->cadastrar();
        // $obDataBase = new Database('ticket');
        
        // echo '<pre>';
        // print_r($obDataBase);
        // echo '</pre>';exit;

        return self::TicketFormular();
    }
}