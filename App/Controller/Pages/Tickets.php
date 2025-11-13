<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Ticket;

class Tickets extends Page{

    public static function TicketsDetails($request){
        
        $results = Ticket::getTickets(null, 'id DESC');
        $content = '';
        while($obTicket = $results->fetchObject(Ticket::class)){
            $content .= View::render('pages/ticket/itens', [
                'id'        => $obTicket->id,
                'veiculo'   => $obTicket->veiculo,
                'dtHoraIni' => date('d/m/Y H:i:s', strtotime($obTicket->dtHoraIni)),
                'dtHoraFim' => date('d/m/Y H:i:s', strtotime($obTicket->dtHoraFim))
            ]);
        }

        return $content;
    }
    

    public static function Tickets($request){
        
        // ticketsDetails

        $content = View::render('pages/ticket/tickets', [
            'ticketsDetails' => self::TicketsDetails($request)
            ]
        );


        return parent::getPage($content);
    }
    public static function TicketFormular($idTicket = null, $request = null){
        

        
        // $obDataBase = new Database('ticket');
        // $obDataBase->update('id = 1', ['veiculo'=>'teste']);

        $obTicket = isset($idTicket) ? (new Ticket())->getTickets('id = ' . $idTicket)[0] : new Ticket();
       
        
        $content = View::render('pages/ticket/formular', [
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

        return self::Tickets($request);
    }
}