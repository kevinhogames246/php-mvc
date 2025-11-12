<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php'; ?>
<head>
    <link rel="stylesheet" href="../css/estilo-login.css">
    <script src="../js/javascript.js"></script>

</head>

<body>
    <div id="container_login">
        <img id="logo" src="../img/Health Track.png" alt="Health Track logo">


        <label class="switch">
            <input type="checkbox" onChange="toggle_login()" name="toggle">
            <div class="slider round">
                <span class="slider_text">
                    <span class="off">Consultar</span>
                    <span class="on">Login</span>
                </span>
            </div>
        </label>


        <!-- <form class="forms" method="post" action="index.php"> -->
            <form class="forms" method="post" action="../controllers/OffController.php">
            <div id="campos_login">
                <div class="label-float">
                    <input type="text" name="emailPessoa" id="E-mail" placeholder=" " value="">
                    <label for="email">Email:</label>
                </div>
                <div class="label-float">
                    <input type="password" name="senhaPessoa" id="Senha" placeholder=" " value="">
                    <label for="senha">Senha:</label>
                </div>
                <a href="esqueceuSenha">
                    <p>Esqueceu a senha?</p>
                </a>
                <button type="submit" value="login" name="action" class="entrar">Login</button>
            </div>

            <div id="campo_consultar">
                <div class="div_pesquisa">
                    <div class="label-float">
                        <input name="protocolo" placeholder=" " type="text">
                        <label for="protocolo">Código de Consulta</label>
                        <button type="submit" value="consultar" name="action" id="btn_lupa"><i class="bi bi-search" style="font-size: 22px; margin-left: 8px;"></i></button>
                    </div>
                </div>
            </div>
        </form>

        <?php include '../components/notificacao.php'; ?>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>