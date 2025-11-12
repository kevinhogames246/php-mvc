<?php

namespace App\Controller\Pages;

use \App\Utils\View;
use \App\Model\Entity\Ticket;

class Tickets extends Page{

    public static function Tickets(){
        $obTicket = new Ticket();

        $content = View::render('pages/tickets', [
            'veiculo'   => $obTicket->veiculo,
            'dtHoraIni' => $obTicket->dtHoraIni,
            'dtHoraFim' => $obTicket->dtHoraFim
        ]);

        return parent::getPage($content);
    }
}