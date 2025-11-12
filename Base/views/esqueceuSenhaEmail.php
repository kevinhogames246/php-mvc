<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php'; ?>

<head>
    <link rel="stylesheet" href="../css/estilo-esqueceuSenha.css">
</head>

<body>
    <a href="javascript:btn_voltar()">
        <div id="seta_voltar">
            <i class="bi bi-chevron-left"></i>
        </div>
    </a>
    <div id="container">
        <h3 id="titulo">Esqueceu a Senha</h3>

        <p id="p_aviso">Estamos quase lá, digite o código que chegou em seu email!</p>

        <form class="forms" method="POST" action="../controllers/OffController.php">
            <input type="hidden" value="esqueceuSenha" name="tabela">
            <div class="label-float">
                <input type="text" name="email" id="email" placeholder=" " value="">
                <label for="email">Código de verificação</label>
            </div>

            <button class="btn_padrao">Enviar</button>
        </form>
    </div>
    <script src="../js/javascript.js"></script>
</body>

</html>