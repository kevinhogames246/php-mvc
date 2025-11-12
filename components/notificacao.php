<?php
    $tipo = $_POST['tipo'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';
    if($tipo != '' and $mensagem != ''){
        echo "<script>mostraNotificacao('" . $mensagem . "', '" . $tipo . "');</script>";
    }
?>