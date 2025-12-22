<?php

namespace App\Controller\Common;


use \App\Utils\View;
use \App\Http\Request;
use \App\Model\Entity\User;

use \App\Session\Common\Login as SessionLogin;

class Login extends Page
{

    /**
     * Metodo responsavel por retornar a renderizção da pagina de login
     * @param Request $request
     * @return string
     */
    public static function getLogin($request, $errorMenssage = null)
    {


        $status = !is_null($errorMenssage) ? View::render('admin/login/status', [
            'menssagem' => $errorMenssage
        ]) : '';

        $content = View::render('admin/login', [
            'status' => $status
        ]);

        return parent::getPage('Login > balancAlles', $content);
    }

    /**
     * Metodo responsavel por definir o login do usuário
     * @param Request $request
     * @return string
     */
    public static function setLogin($request)
    {
        $postVars = $request->getPostVars();
        $email = $postVars['email'] ?? '';
        $senha = $postVars['senha'] ?? '';

        

        $obUser = User::getUserByEmail($email);
        
        if(!$obUser instanceof User or !password_verify($senha, $obUser->senha)){
            return self::getLogin($request, 'E-mail ou senha invalidos');
        }

        SessionLogin::login($obUser);
        
        $request->getRouter()->redirect('/admin');

        $content = '';
        return parent::getPage('Login > balancAllesqwe', $content);
    }

    /**
     * Metodo responsavel por deslogar o usuário
     * @param Request $request
     * @return void
     */
    public static function setLogout($request){

        SessionLogin::logout();

        $request->getRouter()->redirect('/admin/login');

    }
}
