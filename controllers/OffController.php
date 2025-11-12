<html lang="pt-br">

</html>
<?php
require_once '../config/db.php';
require_once 'AuthController.php';

session_start();
$authController = new AuthController($db);

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
}

switch ($action) {
    case 'login':
        $user = $_POST['user'];
        $senha = $_POST['senha'];
        var_dump($authController->login($user, $senha));
        if ($authController->login($user, $senha)) {
            // header('Location: ./return.php?tipo=x&mensagem=Logado&destino=../views/index'); // Redirecionar para a página de dashboard após o login
            header('Location: ../views/');
            // header('Location: ./return.php?tipo=check' .
            //     '&mensagem=Bem vindo' .
            //     '&destino=..~views~index');
        } else {
            header('Location: return.php?tipo=x' .
                '&mensagem=login invalido' .
                '&destino=..~views~login');
        }
        break;
    default:
        echo "<script>alert('Tabela não existe.')</script>";
    // header('Location: return.php?tipo=x' .
    // '&mensagem=tabela não existe' .
    // '&destino=../views/ERRO');
    // exit;
}
