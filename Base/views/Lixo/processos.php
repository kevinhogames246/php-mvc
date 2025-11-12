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
    <link rel="stylesheet" href="../css/components/botao_voltar.css">
    <link rel="stylesheet" href="../css/estilo-index.css">
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
    
        <a href="dashboard.php">
            <div id="seta_voltar">
                <i class="bi bi-chevron-left" style="font-size: 28px"></i>
            </div>
        </a>

    <h3 id="titulo">Processos Ativos</h3>

    <form class="forms" action="">
        <div class="label-float">
        <input  name="processo" placeholder=" " type="text">
        <label for="processo">Buscar Processos</label>
        <button id="btn_lupa"><i class="bi bi-search" style="font-size: 22px; margin-left: 8px;"></i></button>
        </div>
    </form>
        
    <div id="processos_ativos">
        <?php
            $processos = $authController->getAllProcessosAtivos();
                    
                    
            foreach ($processos as $processo): ?>   
            <div class="processo">
                <p>Protocolo do processo: <?= $processo['protocoloProcesso'] ?></p>
                <p>Paciente: <?= $processo['nomePessoa'] ?></p>
                <p>Data de inicio: <?= $processo['dataInicialProcesso'] ?></p>

                <div class="btn_processo">
                    <a href="processo.php?protocoloProcesso=<?= $processo['protocoloProcesso'] ?>&vemDe=processos">
                        <div id="btn_visualizar">
                            <img src="../img/logo_visualizar.png" width="42.66px" height="42.66px" alt="" srcset="">
                            <p>Visualizar</p>
                        </div>
                    </a>
                    <a href=""></a>
                        <img src="../img/logo_excluir.png" width="36.66px" height="45.33px" alt="" srcset="">
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php elseif ($usuario['tipoPessoa'] === 'user'): if (isset($_SESSION['idPessoa'])) { header('Location: paciente.php?idPessoa=' . $_SESSION['idPessoa']); exit;};?>
    <?php else: ?>
        <h1 id="titulo">Erro 404</h1>
        <!-- Conteúdo específico para Usuários -->
    <?php endif; ?>

    <a href="logout.php">Logout</a>
    <script src="../js/bootstrap.bundle.js" ></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.esm.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/javascript.js"></script>
</body>
</html>
