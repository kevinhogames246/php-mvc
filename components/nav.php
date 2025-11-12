<nav class="navbar">
    <a class="case-button" tabindex="-1" href="movimentar.php">
        <button class="red-1 btn_padrao">Movimentar</button>
    </a>
    <div>
        <p>Olá, <?= $_SESSION['nome'] ?></p>
        <a class="case-button" href="javascript:dialog()"><button tabindex="-1" class="red-2">Sair da Conta</button></a>
    </div>
</nav>

<dialog class="dialogo">
    <div id="div_dialogo">
        <p>Tem certeza que deseja sair?</p>
        <div class="div_botoes">
            <div class="case-button"><button id="cancelar" class="red-2">Cancelar</button></div>
            <a class="case-button" href="logout.php"><button id="confirmar" class="green-1">Confirmar</button></a>
        </div>
    </div>
</dialog>

<!-- <div class="fundo">
    <img src="../img/e.png" alt="">
</div> -->