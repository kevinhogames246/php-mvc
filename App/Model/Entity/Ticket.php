<?php

namespace App\Model\Entity;

// use \WilliamCosta\DatabaseManager\Database;
use \App\Db\Database;
use PDO;

class Ticket{

    public $id;
    public $veiculo;
    public $dtHoraIni;
    public $dtHoraFim;

    public function cadastrar(){
        $this->dtHoraIni = date('Y-m-d H:i:s');
        $this->id = (new Database('ticket'))->insert([
            'veiculo'   => $this->veiculo,
            'dtHoraIni' => $this->dtHoraIni,
            'dtHoraFim' => $this->dtHoraFim
        ]);

        return true;
    }
    public function alterar(){
        $this->dtHoraIni = date('Y-m-d H:i:s');
        $this->id = (new Database('ticket'))->insert([
            'veiculo'   => $this->veiculo,
            'dtHoraIni' => $this->dtHoraIni,
            'dtHoraFim' => $this->dtHoraFim
        ]);

    }

    public static function getTickets($where = null, $order = null, $limit = null, $fields = '*'){
        return (New Database('ticket'))->select($where, $order, $limit, $fields);
    }
}