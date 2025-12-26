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

    public static function getUserByEmail($email){      
        return (new Database('usuarios'))->select(null,'email = "' . $email . '"')->fetchObject(self::class);
    }

    /**
     * Metodo responsavel por retornar as roles (permissões) do usuário
     * @return array
     */
    public function getRoles() {
        $roles = [];
        
        // Query que busca os nomes das roles associadas ao ID do usuário
        $results = (new Database('usuarios_roles'))->select(
            'inner join roles on roles.id = usuarios_roles.role_id',
            'usuarios_roles.usuario_id = '.$this->id,
            null,
            null,
            'roles.nome'
        );
        
        
        while($role = $results->fetchObject()){
            $roles[] = $role->nome;
        }
    
        return $roles; // Retorna ex: ['admin', 'atualizador']
    }
}