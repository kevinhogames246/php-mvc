<html lang="pt-br"></html>
<?php
session_start();
require_once '../config/db.php';
require_once 'AuthController.php';

$authController = new AuthController($db);

if (!isset($_SESSION['user'])) {
    header('Location: ../views/login.php');
    exit;
}
// $usuario = $authController->getPessoaById($_SESSION['id']);

if (isset($_GET['tabela'])) {
    $tabela = $_GET['tabela'];
}

// if (isset($_GET['idCrear'])) {
//     $idCrear = $_GET['idCrear'];
// }

switch ($tabela) {
    case "movimento":

        $acao = $_POST['acao'] ?? 'Cadastrar';
        $tipo = "x";
        $mensagem = "Erro no movimentado";
        $destino = $acao == "Cadastrar" ? "..~views~index" : "..~views~movimentar";
        $prod = $_POST['prod'] ?? '';
        $end = $_POST['end'] ?? '';
        $tipo = $_POST['tipo'] ?? '';
        $quant = $_POST['quant'] ?? '';
        $movimento = $authController->
        registerMovimento($prod, $end, $tipo, $quant, $_SESSION['id']);
        
        // echo var_dump($prod) . "<br>";
        // echo var_dump($end) . "<br>";
        // echo var_dump($tipo) . "<br>";
        // echo var_dump($quant) . "<br>";
        // echo var_dump($movimento === false) . "<br>";

        if ($movimento !== true) {
            $mensagem = $movimento;
            $destino = "..~views~movimentar";
        } else {
            $tipo = "check";
            $mensagem = "Movimentado";
        }

        // echo var_dump($mensagem) . "<br>";
        // exit;

        header('Location: ./return.php?tipo=' . $tipo . '&mensagem=' . $mensagem . '&destino=' . $destino . '');
        break;
    case "usuario":
        $tipo = "x";
        $mensagem = "Erro no cadastro";
        $destino = "..~views~usuarios";
        $nome = $_POST['nome'] ?? '';
        $user = $_POST['usuario'] ?? '';
        $nivel = $_POST['nivel'] ?? '';
        $id = $_POST['id'] ?? '';

        echo $id . "<br>";
        echo $nome . "<br>";
        echo $user . "<br>";
        echo $nivel . "<br>";

        if($_POST['acao'] == 'create'){
            $usuario = $authController->
            registerUsuario($nome, $user, $nivel);
        }else{
            $usuario = $authController->
            updateUsuario($nome, $id, $nivel);
        }
        
        if ($usuario != false) {
            $tipo = "check";
            $mensagem = "Criado";
        } else {
            $destino = "..~views~movimentar";
        }
        
        header('Location: ./return.php?tipo=' . $tipo . '&mensagem=' . $mensagem . '&destino=' . $destino . '');
        break;
    default:
    echo "<script>alert('Tabela não existe.')</script>";
        exit;
}
