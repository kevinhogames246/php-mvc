<?php
    $tipo = $_POST['tipo'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';
    // echo "<script>alert('" .$mensagem . $tipo . "')</script>";
    // <!-- <script>mostraNotificacao('teste', 'check')</script> -->
    // <!-- <script>mostraNotificacao('teste', 'exclamation')</script> -->
    // <!-- <script>mostraNotificacao('teste', 'x')</script> -->
    // <!-- <script>mostraNotificacao('teste', 'dash')</script> -->
    
    if ($mensagem == 'login invalido'){
        // header("Refresh: 4. url=login");
    }
    if($tipo != '' and $mensagem != ''){
        echo "<script>mostraNotificacao('" . $mensagem . "', '" . $tipo . "')</script>";
    }
?>