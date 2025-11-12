<?php
session_start();
require_once '../config/db.php'; 
require_once '../controllers/authController.php';
// require_once dirname(__FILE__) . '/../models/Users.php';
require_once dirname(__FILE__) . '/../models/Pessoas.php';


$authController = new authController($db);
$pessoasModel = new Pessoas($db);

if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
}

$usuario = $authController->getPessoaByEmail($_SESSION['emailPessoa']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilo-basico.css">
    <link rel="stylesheet" href="../css/components/bemvindo.css">
    <link rel="stylesheet" href="../css/components/inputs.css">
    <link rel="stylesheet" href="../css/estilo-index.css">
    
    <link rel="stylesheet" href="../css/components/botao.css">
    <title>Health Track</title>

</head>
<body>
    <nav class="navbar navbar-light">
        <a class="navbar-brand" id="logo" href="index.php">
            <img src="../img/Health Track.png" width="100%" height="40px" class="d-inline-block align-top" alt="">
        </a>
            
        <div class="theme-container shadow-dark">
            <img id="theme-icon" src="https://www.uplooder.net/img/image/2/addf703a24a12d030968858e0879b11e/moon.svg" alt="ERR">
        </div>  
            
        <div id="div_login">
            <div id="foto_login">
                <i class="bi bi-person" style="font-size: 27px; color: white;"></i>
            </div>
            <p id="nome_login">Olá, <?= $_SESSION['nomePessoa'] ?></p>
        </div>
    </nav>
    
    <?php if ($usuario['tipoPessoa'] === 'admin'): ?>
    
    <a href="pacientes.php"><h3 id="titulo">Pacientes - check</h3></a>
    <a href="processos.php"><h3 id="titulo">Processos Ativos - check</h3></a>
    <a href="procedimentos.php"><h3 id="titulo">procedimentos - Falta Editar</h3></a>
    <a href="unidadesDeSaude.php"><h3 id="titulo">Unidade de Saúde - nop</h3></a>
    <a href="logout.php"><h3 id="titulo">Logout</h3></a>
    
    <?php elseif ($usuario['tipoPessoa'] === 'user'): if (isset($_SESSION['idPessoa'])) { header('Location: paciente.php?idPessoa=' . $_SESSION['idPessoa']); exit;};?>
    <?php else: header('Location: login.php');?>

        
        <!-- Conteúdo específico para Usuários -->
    <?php endif; ?>

    
    <script src="../js/bootstrap.bundle.js" ></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.esm.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/javascript.js"></script>
</body>
</html>
