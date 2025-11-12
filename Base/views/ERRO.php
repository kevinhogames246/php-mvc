<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php'; ?>
<head>
    <link rel="stylesheet" href="../css/estilo-erro.css">
</head>

<body>
    <div id="container">
        <div>
            <img id="logo_erro" src="../img/logo erro.jpg" alt="Imagem com alerta de erro">
        </div>
        <div>
            <h1>Parece que ocorreu um erro inesperado!</h1>
            <br>
            <p>Por favor clique abaixo e volte ao inicio</p>
            <br>
            <a href="login"><button tabindex="-1" class="btn_padrao">Voltar ao ínicio</button></a>
        </div>
    </div>

    <img id="logo_ht" src="../img/Health Track.png" alt="Logo do Health Track">


    <?php include '../components/notificacao.php'; ?>
</body>
</html>