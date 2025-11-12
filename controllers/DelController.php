<?php
session_start();
require_once '../config/db.php';
require_once 'AuthController.php';

$authController = new AuthController($db);

// if (!isset($_SESSION['emailPessoa'])) {
//     header('Location: login.php');
//     exit;
// }

// $usuario = $authController->getPessoaById($_SESSION['idPessoa']);

// echo "<script>alert('" . $usuario['tipoPessoa'] . "')</script>";

// if ($usuario['tipoPessoa'] !== 'admin') {
//     header('Location: ../index.php');
//     exit;
// }

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
    case "toner":
        if ($authController->deleteToner($idExcluir)) {
            echo "<script>alert('Toner excluído com sucesso.')</script>";
            header('Location: ../views/toners.php');
            exit;
        } else {
            echo "<script>alert('Erro ao excluir o toner.')</script>";
            header('Location: ../views/toners.php');
        }
        break;
    default:
        echo "<script>alert('Tabela não existe.')</script>";
        include '../components/head.php';
        include '../components/erro.php';
        exit;
}
