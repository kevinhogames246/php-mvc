<?php
session_start();


require_once '../config/db.php';
require_once '../controllers/authController.php';

$authController = new authController($db);


$usuario = $authController->getPessoaById($_SESSION['idPessoa']);

if (!isset($_SESSION['emailPessoa'])) {
    echo '<script>alert("' . 2 . '");</script>';
    header('Location: login.php');
    exit;
}

// echo $_SESSION['OP'];
// echo $OP;
?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../components/head.php'; ?>
<head>
    <link rel="stylesheet" href="../css/estilo-index.css">
</head>

<body>



        <?php 
        if ($_SESSION['OP'] === 'admin' or $_SESSION['OP'] === 'medic' or $_SESSION['OP'] === 'enfer' or $_SESSION['OP'] === 'recep') : 
        ?>
        <?php 
            // if ($usuario['tipoPessoa'] === 'admin' or $usuario['tipoPessoa'] === 'user') : 
            ?>
        
        <?php include '../components/nav.php'; ?>

        <div id="div_bemvindo">
            <h1>Olá <span> <?= $_SESSION['nomePessoa'] ?></span>,<br>Bem vindo ao<br>Health Track.</h1>
            <img src="../img/imagem bemvindo.jpg" alt="Foto de um notebook com ícones e logo do Health Track" srcset="">
        </div>

        <h3 id="titulo">Processos Ativos</h3>

        <div class="div_pesquisa">
            <form class="forms" action="">
                <div class="label-float">
                    <input name="busca" placeholder=" " type="text">
                    <label for="busca">Buscar Processos</label>
                    <button><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>

        <div id="processos_ativos">
            <div class="processo cadastrar">
                <div class="btn_icone">
                    <a href="processoCadastra.php">
                        <i class="bi bi-plus-lg" style="font-size: 100px; color: var(--primary-color);"></i>
                        <p>Cadastrar</p>
                    </a>
                </div>
            </div>
            <?php
            $processos = $authController->getAllProcessosAtivos();
            foreach ($processos as $processo) :
            ?>
                <div class="processo">
                    <p>Código do processo: <?= $processo['protocoloProcesso'] ?></p>
                    <p>Paciente: <?= $processo['nomePessoa'] ?></p>
                    <p>Data de inicio: <?= date('d/m/Y', strtotime($processo['dataInicialProcesso'])) ?> </p>

                    <div class="btn_processo">
                        <a href="processoEdita.php?protocoloProcesso=<?= $processo['protocoloProcesso'] ?>">
                            <div id="btn_visualizar">
                                <img src="../img/logo_visualizar.png" width="42.66px" height="42.66px" alt="Ícone de olho" srcset="">    
                                <p>Visualizar</p>
                            </div>
                        </a>
                        <a href="javascript:mostraCaixa(<?= $processo['idProcesso'] ?>, 'processo')">    
                            <img src="../img/logo_excluir.png" width="36.66px" height="45.33px" alt="Ícone de lixeira" srcset="">
                        </a>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

    <?php elseif ($_SESSION['OP'] === 'user') :
        if (isset($_SESSION['idPessoa'])) {
            header('Location: paciente.php?idPessoa=' . $_SESSION['idPessoa']);
            exit;
        };
    ?>
    <?php else : header('Location: login.php'); ?>
    <?php endif; ?>

    <?php include '../components/footer.php'; ?>
    <?php include '../components/notificacao.php'; ?>

    <script src="../js/javascript.js"></script>
</body>

</html>