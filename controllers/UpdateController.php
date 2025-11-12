<html lang="pt-br"></html>
<?php
// session_start();
require_once '../config/db.php';
require_once 'AuthController.php';

$authController = new AuthController($db);

// if (!isset($_SESSION['emailPessoa'])) {
//     header('Location: login.php');
//     exit;
// }

// $usuario = $authController->getPessoaById($_SESSION['idPessoa']);

// // echo "<script>alert('" . $usuario['tipoPessoa'] . "')</script>";

// if ($usuario['tipoPessoa'] !== 'admin') {
//     header('Location: ../index.php');
//     exit;
// }

if (isset($_GET['tabela'])) {
    $tabela = $_GET['tabela'];
}
if (isset($_GET['idUpdate'])) {
    $idUpdate = $_GET['idUpdate'];
}

switch ($tabela) {
    case "movimento":
        $prod = $_POST[''];
        $modelo = $_POST['modelo'];
        $cor = $_POST['cor'];
        $cheio = $_POST['cheio'];
        $vazio = $_POST['vazio'];
        $paciente = $authController->updateToner($idUpdate, $modelo, $cor, $cheio, $vazio);
        
        // header('Location: pacientes.php');
        if ($paciente != false) {
            echo "<script>alert('Sucesso')</script>";
            // header('Location: ../views/toners.php');
        } else {
            echo "<script>alert('Erro')</script>";
        // header('Location: ../views/toners.php');
        } 

        break;
    default:
        echo "<script>alert('Tabela não existe.')</script>";
        exit;
}
