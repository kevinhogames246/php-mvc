<html lang="pt-br"></html>
<?php
require_once '../config/db.php';
require_once 'AuthController.php';

session_start();
$authController = new AuthController($db);

if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
}

switch ($action) {
    case 'consultar':
        $protocolo = $_POST['protocolo'];
        echo '<script>alert("Login inválido.")</script>';
        $_SESSION['nomePessoa'] = "Faça Login";
        header('Location: ../views/processoEdita.php?protocoloProcesso=' . $protocolo);
        break;
    case 'login':
        $emailPessoa = $_POST['emailPessoa'];
        $senhaPessoa = $_POST['senhaPessoa'];

        if ($authController->loginPessoa($emailPessoa, $senhaPessoa)) {
            header("Location: ../views/index.php"); // Redirecionar para a página de dashboard após o login
        } else {
            header('Location: ../controllers/return.php?tipo=x' .
                '&mensagem=login invalido' .
                '&destino=../views/login.php');
        }
    break;
    case "enviaCodigo":
        $emailPessoa = $_POST['emailPessoa'] ?? '';
        
        if ($paciente != false) {
            // header('Location: ../views/esqueceuSenhaEmail');
        } else {
            // header('Location: ../views/esqueceuSenhaEmail');
        }
        break;
    case "esqueceuSenha":
        $emailPessoa = $_POST['emailPessoa'];

        if ($paciente != false) {
            // header('Location: ../views/esqueceuSenhaEmail');
        } else {
            // header('Location: ../views/esqueceuSenhaEmail');
        }

        break;
    default:
     echo "<script>alert('Tabela não existe.')</script>";
        // header('Location: return.php?tipo=x' .
            // '&mensagem=tabela não existe' .
            // '&destino=../views/ERRO');
        // exit;
}
