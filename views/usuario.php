<?php
session_start();

require_once '../config/db.php';
require_once '../controllers/authController.php';

$authController = new authController($db);

if (!isset($_SESSION['user']) || $_SESSION['nivel'] > 0) {
    header('Location: login.php');
    exit;
}

$usuario = $authController->getUsuarioByUser($_SESSION['user']);

?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php'; ?>

<head>
    <link rel="stylesheet" href="../css/estilo-movimentar.css">
    <!-- <script src="../js/javascript.js"></script> -->
</head>

<body>
    <?php include '../components/nav.php'; ?>

    <div class="div_voltar">
        <a class="case-button" tabindex="-1" href="../controllers/Ajax.php?voutar=..~views~">
            <button class="orange-1">Voltar</button>
        </a>
    </div>
    <section class="container">

        <?php
        if (true) {
            ?>
            <h3 class="titulo"><?= isset($_GET['codigo']) ? 'Atualizar' : 'Cadastrar' ?> Usuário</h3>

            <form onemptied="getUser()" class="forms" action="../controllers/CreateController.php?tabela=usuario"
                method="POST" enctype="">
                <input type="hidden" name="id" id="id" value="<?= isset($_GET['codigo']) ? $_GET['codigo'] ?? '' : '' ?>">
                <label for="nome">Nome:</label>
                <input required onclick="limparEnd()" type="text" name="nome" id="nome"><br>

                <label for="usuario">Usuario:</label>
                <input <?= isset($_GET['codigo']) ? 'disabled' : 'required' ?> type="text" name="usuario" id="usuario"><br>

                <label for="nivel">nivel:</label>
                <input required type="number" name="nivel" id="nivel"><br>

                <div class="Enviar">
                    <div class="case-button">
                        <button type="submit" class="red-1" name="acao" value="<?= isset($_GET['codigo']) ? 'update' : 'create' ?>"><?= isset($_GET['codigo']) ? 'Atualizar' : 'Cadastrar' ?></button>
                    </div>
                </div>
                </from>
            <?php }
        ; ?>
    </section>
    <script src="../js/usuario.js"></script>

    <?php include '../components/footer.php'; ?>
    <?php include '../components/notificacao.php'; ?>
</body>

</html>