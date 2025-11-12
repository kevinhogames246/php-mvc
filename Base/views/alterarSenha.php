<?php
    session_start();
    require_once '../config/db.php'; 
    require_once '../controllers/AuthController.php';


    $authController = new AuthController($db);

    if (!isset($_SESSION['emailPessoa'])) {
        header('Location: login.php');
        exit;
    }

    $usuario = $authController->getPessoaByEmail($_SESSION['emailPessoa']);

    $vaiPra = $_GET['vaiPra'] ?? '';
    $idPessoa = $_GET['idPessoa'];
    $pessoa = $authController->getFuncionarioByPessoa($idPessoa);

?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include '../components/head.php'; ?>

<body>
    
    <?php include '../components/nav.php'; ?>

    <a href="javascript:btn_voltar()">
        <div id="seta_voltar">
            <i class="bi bi-chevron-left"></i>
        </div>
    </a>

    <h3 id="titulo">Alterar Senha</h3>

    <form class="forms" method="POST" action="../controllers/UpdateController.php?tabela=pessoaSenha&idUpdate=<?= $idPessoa ?>">

        <div class="label-float">
            <input type="text" name="novaSenha_1" id="novaSenha_1" placeholder=" " value="">
            <label for="novaSenha_1">Nova Senha:</label>
        </div>

        <div class="label-float">
            <input type="text" name="novaSenha_2" id="novaSenha_2" placeholder=" " value="">
            <label for="novaSenha_2">Nova Senha:</label>
        </div>

        <!-- Tirar type="button" (somente para teste da notificação) -->
        <button style="margin: 28px" class="btn_padrao">Cadastrar</button>
    </form>

    <?php include '../components/footer.php'; ?>

    <script src="../js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>