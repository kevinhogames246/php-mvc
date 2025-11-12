<?php
session_start();
        echo isset($_SESSION['user']);
    $tipo = $_GET['tipo'] ?? '';
    $mensagem = $_GET['mensagem'] ?? '';
    $destino = str_replace("~","/", $_GET['destino']) ?? '';
?>

<form id="meuFormulario" action="<?= $destino ?>.php" method="POST">
    <input type="hidden" name="mensagem" value="<?= $mensagem ?>">
    <input type="hidden" name="tipo" value="<?= $tipo ?>">
    <input type="submit" name="Enviar" style="display: none;">
</form>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var formulario = document.getElementById('meuFormulario');
        formulario.submit();
    });
</script>