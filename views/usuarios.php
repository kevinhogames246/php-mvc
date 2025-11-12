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
    <link rel="stylesheet" href="../css/estilo-estoques.css">
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
        <div class="div_pesq_cadastro">
            <div class="label-float">
                <input class="red-1" id="busca" placeholder=" " type="search" <?= (isset($_GET['codigo'])) ? 'value="' . $codigo = $_GET['codigo'] . '"' ?? '' : '' ?>>
                <label for="busca">Buscar</label>
            </div>
            <div class="select">
                <select id="campo">
                    <option value="nome">Nome</option>
                    <option value="usuario">Usuario</option>
                    <option value="nivel">Nivel</option>
                </select>
            </div>
            <div onclick="searchUser()" class="case-button"><button class="red-2">Search</button></div>
        </div>
        <div class="pageInput">
            <div class="case-button">
                <button class="red-2" onclick="previousPage()"><</button>
            </div>
            <input class="red-1" type="number" id="page" onchange="getUser()" value="1">
            <div class="case-button">
                <button class="red-2" onclick="nextPage()">></button>
            </div>
        </div>
    </section>
    <section class="container table-container">
        <table>
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>
    </section>

    <script src="../js/usuarios.js"></script>
    <?php include '../components/footer.php'; ?>

    <script>
        // getEnd();        
    </script>
</body>

</html>