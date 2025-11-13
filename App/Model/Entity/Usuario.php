<?php

namespace App\Model\Entity;

class Usuario{

    public $id;
    public $user;
    public $senha;
    public $nome;

    public function cadastrar(){
        echo '<pre>';
        print_r($this );
        echo '</pre>';exit;

    }
}