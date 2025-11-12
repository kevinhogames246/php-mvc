<?php
session_start();
require_once '../config/db.php';
require_once 'AuthController.php';

$authController = new AuthController($db);

if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
}

$usuario = $authController->getPessoaById($_SESSION['idPessoa']);

// echo "<script>alert('" . $usuario['tipoPessoa'] . "')</script>";

if ($usuario['tipoPessoa'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

if (isset($_GET['tabela'])) {
    $tabela = $_GET['tabela'];
}
if (isset($_GET['idExcluir'])) {
    $idExcluir = $_GET['idExcluir'];
}

// else{
//     header('Location: ../views/pacientes.php?' . 'error=erro ao excluir!');
// }

switch ($tabela) {
    case "paciente":
        if ($authController->deletePaciente($idExcluir)) {
            echo "<script>alert('Usuário excluído com sucesso.')</script>";
            header('Location: return.php?tipo=check' . 
                '&mensagem=paciente exluido com sucesso' .
                '&destino=../views/pacientes.php');
            exit;
        } else {
            echo "<script>alert('Erro ao excluir o usuário.')</script>";
            header('Location: return.php?tipo=check' . 
                '&mensagem=erro ao exluir paciente' .
                '&destino=../views/pacientes.php');
        }
        break;
        
    case "funcionario":
        if ($authController->deleteFuncionario($idExcluir)) {
            echo "<script>alert('Usuário excluído com sucesso.')</script>";
            header('Location: return.php?tipo=check' . 
                '&mensagem=funcionario excluido com sucesso' .
                '&destino=../views/funcionarios.php');
            exit;
        } else {
            echo "<script>alert('Erro ao excluir o usuário.')</script>";
            header('Location: return.php?tipo=check' . 
                '&mensagem=erro ao exluir' .
                '&destino=../views/funcionarios.php');
        }
        break;
    case "processo":
        if ($authController->deleteProcesso($idExcluir)) {
            header('Location: return.php?tipo=check' . 
            '&mensagem=processo excluido com sucesso' .
            '&destino=../views/index.php');
            exit;
        } else {
            header('Location: return.php?tipo=check' . 
                '&mensagem=erro ao exluir' .
                '&destino=../views/index.php');
        }
        break;

    case "procedimento":
        $vemDe = $_GET['vemDe'];
        if ($authController->deleteProcedimento($idExcluir)) {
            header('Location: return.php?tipo=check' . 
            '&mensagem=procedimento excluido com sucesso' .
            '&destino=../views/processoEdita.php?protocoloProcesso=' . $vemDe);
            exit;
        } else {
            header('Location: return.php?tipo=x' . 
            '&mensagem=Erro ao excluir processo' .
            '&destino=../views/processoEdita.php?protocoloProcesso=' . $vemDe);
        }
        break;
    
    case "uniSaude":
        if ($authController->deleteUniSaude($idExcluir)) {
        //    echo 'teste';
            header('Location: return.php?tipo=check' . 
            '&mensagem=Unidade excluida com sucesso' .
            '&destino=../views/unidades.php');
            // // exit;
        } else {
            header('Location: return.php?tipo=x' . 
            '&mensagem=Erro ao excluir unidade' .
            '&destino=../views/unidades.php');
        }
        break;

    default:
        echo "<script>alert('Tabela não existe.')</script>";
        include '../components/head.php';
        include '../components/erro.php';
        exit;
}
