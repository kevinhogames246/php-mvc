<?php
session_start();
require_once '../config/db.php';
// require_once 'Users.php';
require_once 'Pessoas.php';
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

if (isset($_GET['idPessoa'])) {
    $idPessoa = $_GET['idPessoa'];
} else {
    echo "Usuário não especificado.";
    exit;
}

if ($authController->deletePaciente($idPessoa)) {
    header('Location: ../views/pacientes.php');
    exit;
} else {
    echo "Erro ao excluir o usuário.";
}
?>
