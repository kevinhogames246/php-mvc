<?php
    $tipo = $_GET['tipo'] ?? '';
    $mensagem = $_GET['mensagem'] ?? '';
    $destino = $_GET['destino'] ?? '';
    // echo "<script>alert('" . $mensagem . $tipo . $destino . "')</script>";
?>

<form id="meuFormulario" action="<?= $destino ?>" method="POST">
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