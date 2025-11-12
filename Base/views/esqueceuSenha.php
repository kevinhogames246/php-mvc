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

        <p id="p_aviso">Digite abaixo seu email para trocar sua senha, será enviado um código de verificação!</p>

        <form class="forms" method="POST" action="../controllers/OffController.php">
            <input type="hidden" value="enviaCodigo" name="action">
            <div class="label-float">
                <input type="text" name="email" id="email" placeholder=" " value="">
                <label for="email">Email:</label>
            </div>

            <button style="margin: 28px" class="btn_padrao">Enviar</button>
        </form>
    </div>
    <script src="../js/javascript.js"></script>
</body>
</html>