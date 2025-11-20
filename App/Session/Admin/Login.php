<?php

namespace App\Session\Admin;

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

        $_SESSION['admin']['usuario'] = [
            'id' => $obUser->id,
            'nome' => $obUser->nome,
            'email' => $obUser->email
        ];
        
        return true;
    }
    
    /**
     * Metodo responsavel por verificar se o usuario esta logado
     * @return boolean
     */
    public static function isLogged(){
        
        self::init();

        return isset($_SESSION['admin']['usuario']['id']);
    }
}