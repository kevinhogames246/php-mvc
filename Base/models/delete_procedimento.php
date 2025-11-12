<?php
session_start();
require_once '../config/db.php';
require_once '../controllers/AuthController.php';

$db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
$authController = new AuthController($db);

if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
}

$tipoPessoa = $authController->getPessoaTipo($_SESSION['emailPessoa']);

if ($tipoPessoa !== 'admin') {
    header('Location: index.php');
    exit;
}

if (isset($_GET['idProcedimento'])) {
    $idProcedimento = $_GET['idProcedimento'];
} else {
    echo "Usuário não especificado.";
    exit;
}

if ($authController->deleteProcedimento($idProcedimento)) {
    header('Location: ../views/procedimentos.php');
    exit;
} else {
    echo "Erro ao excluir o usuário.";
}
?>
