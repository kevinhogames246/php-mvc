<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Ticket;

class Usuarios extends Page{

    public static function UsuariosDetails($detall = []){
        // $obTicket = new Ticket();

        // ticketsDetails

        $content = View::render('pages/usuarioDetails', $detall);

        return $content;
    }
    

    public static function Usuarios(){
        $obTicket = new Ticket();

        // ticketsDetails

        $content = View::render('pages/usuario', [
            'usuarioDetails' => self::UsuariosDetails([
                                    'id'        => $obTicket->id,
                                    'veiculo'   => $obTicket->veiculo,
                                    'dtHoraIni' => $obTicket->dtHoraIni,
                                    'dtHoraFim' => $obTicket->dtHoraFim
                                ])
            ]
        );


        return parent::getPage($content);
    }
    public static function UsuarioFormular(){
        $obTicket = new Ticket();

        // ticketsDetails

        $content = View::render('pages/TicketFormular', [
            'id'        => $obTicket->id,
            'veiculo'   => $obTicket->veiculo,
            'dtHoraIni' => $obTicket->dtHoraIni,
            'dtHoraFim' => $obTicket->dtHoraFim
            ]
        );


        return parent::getPage($content);
    }
}