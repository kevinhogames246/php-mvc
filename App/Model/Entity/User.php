<?php

namespace App\Model\Entity;

// use \WilliamCosta\DatabaseManager\Database;
use \App\Db\Database;
use PDO;

class User{


    public $id;
    public $nome;
    public $email;
    public $senha;
    public $user;
    public $role;

    public static function getUserByEmail($email){
        return (new Database('usuarios'))->select('email = "' . $email . '"')->fetchObject(self::class);
    }
}