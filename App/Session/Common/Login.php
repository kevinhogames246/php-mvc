<?php

namespace App\Session\Common;

class Login{

    /**
     * Metodo responsavel por iniciar a sessao
     */
    private static function init(){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    /**
     * Metodo responsavel por criar o login do usuário
     * @param User $obUser
     * @return boolean
     */
    public static function login($obUser){

        
        self::init();
        
        $_SESSION['common']['usuario'] = [
            'id'    => $obUser->id,
            'nome'  => $obUser->nome,
            'email' => $obUser->email,
            'roles'  => $obUser->getRoles()
        ];
        
        return true;
    }
    
    /**
     * Metodo responsavel por verificar se o usuario esta logado
     * @return boolean
     */
    public static function isLogged(){
        
        self::init();

        return isset($_SESSION['common']['usuario']['id']);
    }

    /**
     * Metodo responsavel por executar o logout do usuario
     * @return bool
     */
    public static function logout(){

        // inicia a sessao
        self::init();

        unset($_SESSION['common']['usuario']);

        return true;
    }

    /**
     * Metodo responsavel por retornar a funcao (role) do usuario logado
     * @return string|null
     */
    public static function getUserRoles(){
        self::init();

        // Retorna a role ou null se não estiver definida ou logado
        return $_SESSION['common']['usuario']['roles'] ?? null;
    }
}