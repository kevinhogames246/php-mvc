<?php
session_start();
session_destroy();

// echo password_hash(1234, PASSWORD_DEFAULT);
?>
<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php'; ?>

<head>
    <link rel="stylesheet" href="../css/estilo-login.css">
    <!-- <script src="../js/javascript.js"></script> -->
</head>

<body>
    <section class="container container_login">

        <form class="forms" method="POST" action="../controllers/OffController.php">
            <div class="titulo_forms login">
                <span>EstocALLES</span>
            </div>
            <div class="campos_forms login">
                <div class="label-float">
                    <input type="text" name="user" id="E-mail" placeholder=" " value="" required>
                    <label for="email">Usuario:</label>
                </div>
                <div class="label-float">
                    <input type="password" name="senha" id="Senha" placeholder=" " value="" required>
                    <label for="senha">Senha:</label>
                </div>
            </div>
            <div class="case-button">
                <button class="red-2" type="submit" value="login" name="action" class="entrar">Login</button>
            </div>
        </form>
    </section>
</body>
<?php include '../components/footer.php'; ?>
<?php include '../components/notificacao.php'; ?>

</html>