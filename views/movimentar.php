<?php
session_start();

require_once '../config/db.php';
require_once '../controllers/authController.php';

$authController = new authController($db);

if (!isset($_SESSION['user'])) {
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

    <script src="../js/movimentar.js"></script>
    <div class="div_voltar">
        <a class="case-button" tabindex="-1" href="../controllers/Ajax.php?voutar=..~views~">
            <button class="orange-1">Voltar</button>
        </a>
    </div>
    <section class="container">

        <?php
        if (true) {
            ?>
            <h3 class="titulo">Cadastra Movimentação</h3>

            <form onemptied="checkEnd()" class="forms" action="../controllers/CreateController.php?tabela=movimento"
                method="POST" enctype="">
                <label for="prod">Produto:</label>
                <select required onchange="checkEnd()" name="prod" id="prod" value="">
                </select><br>

                <label for="end">Endereço:</label>
                <input required onclick="limparEnd()" onblur="checkEnd()" type="text" name="end" id="end"
                    value="<?= isset($_GET['codigo']) ? $_GET['codigo'] ?? '' : '' ?>"><br>

                <label for="cheio">Quantidade (Kg):</label>
                <input required type="text" name="quant" id="quant"><br>

                <label for="tipo">Tipo:</label>
                <select required name="tipo" id="tipo">
                    <option id="ent" value="Entrada">Entrada</option>
                    <option id="sai" value="Saida">Saida</option>
                </select><br>
                <div class="Enviar">
                    <div class="case-button">
                        <button type="submit" class="red-1" name="acao" value="Cadastrar">Cadastrar</button>
                    </div>
                    <div class="case-button">
                        <button type="submit" class="green-1" name="acao" value="CadastrarMais">Cadastrar e
                            Continuar</button>
                    </div>
                </div>
                </from>
            <?php }
        ; ?>
    </section>
    <?php include '../components/footer.php'; ?>

    <script>
        getProdutos();
    </script>
    <?php include '../components/notificacao.php'; ?>
</body>

</html>