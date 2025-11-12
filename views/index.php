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
    <link rel="stylesheet" href="../css/estilo-index.css">
    <!-- <script src="../js/javascript.js"></script> -->
</head>

<body>
    <?php include '../components/nav.php'; ?>
    <div class="conteudo">
        <section class="container container_guias">
            <!-- <a class="case-button" tabindex="-1" href="movimentar.php">
                <button class="red-1 btn_padrao">Movimentar</button>
            </a> -->
            <a class="case-button" tabindex="-1" href="produtos.php">
                <button class="red-1 btn_padrao">Consulta Estoque de Produtos</button>
            </a>
            <a class="case-button" tabindex="-1" href="estoques.php">
                <button class="red-1 btn_padrao">Estoques por Endereço</button>
            </a>
            <a class="case-button" tabindex="-1" href="movimentos.php">
                <button class="red-1 btn_padrao">Histórico de Movimentos</button>
            </a>
            <?php if ($_SESSION['nivel'] == 0) { ?>
                <a class="case-button" tabindex="-1" href="usuarios.php">
                    <button class="red-1 btn_padrao">Usuarios</button>
                </a>
                <a class="case-button" tabindex="-1" href="usuario.php">
                    <button class="red-1 btn_padrao">Novo Usuario</button>
                </a>
            <?php } ?>
        </section>
        <input class="red-2" type="hidden" id="page" value="1">
        <input class="red-2" type="hidden" id="campo" value="u.usuario">
        <input class="red-2" type="hidden" id="busca" value="<?= $_SESSION['user'] ?>">
        <section class="container table-container">
            <h1>Seus Ultimos Movimentos</h1>
            <table>
                <thead>
                </thead>
                <tbody>
                </tbody>
            </table>
    </div>
    </section>
    </div>

    <script src="../js/movimentos.js"></script>
    <?php include '../components/footer.php'; ?>
    <?php include '../components/notificacao.php'; ?>
</body>

</html>