<nav class="navbar navbar-light">
    <div id="btn_menu">
        <i class="bi bi-list"></i>
    </div>
    <a class="navbar-brand" id="logo" href="index.php">
        <img src="../img/Health Track.png" width="100%" height="40px" class="d-inline-block align-top" alt="Logo do Health Track">
    </a>
    <?php if ($_SESSION['OP'] === 'admin' or $_SESSION['OP'] === 'medic' or $_SESSION['OP'] === 'enfer' or $_SESSION['OP'] === 'recep') : ?>
        <div id="div_links">
            <a href="pacientes.php">
                <p>Pacientes</p>
            </a>
            <?php if ($_SESSION['OP'] != 'recep') : ?>
                <a href="funcionarios.php">
                    <p>Funcionários</p>
                </a>
            <?php endif; ?>
            <?php if ($_SESSION['OP'] === 'admin') : ?>
                <a href="unidades.php">
                    <p>Unidades</p>
                </a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div tabindex="0" class="theme-container shadow-dark">
        <img id="theme-icon" src="https://www.uplooder.net/img/image/2/addf703a24a12d030968858e0879b11e/moon.svg" alt="Ícone do tema">
    </div>
    <?php if ($_SESSION['nomePessoa'] != 'Faça Login') : ?>
        <a href="javascript:dropdown()">
    <?php else : ?>
        <a href="login" id="div_login">
    <?php endif; ?>
    <div id="div_login">
        <?php if ($usuario['arquivoPerfil'] != '') : ?>
            <img id="foto_login" src="../upload/perfil/<?= $usuario['arquivoPerfil'] ?>" alt="">
        <?php else : ?>
            <img id="foto_login" src="../upload/perfil/perfilPadrao.jpg" alt="">
        <?php endif; ?>
        <!-- <img src="img/foto_paciente.jpg" alt="Foto do usuário"> -->
        <p>Olá, <?= $_SESSION['nomePessoa'] ?></p>
    </div>
    </a>

    <div id="div_dropdown">
        <div id="dropdown">
            <?php if ($usuario['tipoPessoa'] != 'user' && $usuario['tipoPessoa'] != '') : ?>
                <a href="funcionario?idPessoa=<?= $usuario['idPessoa'] ?>" id="div_login">
            <?php else : ?>
                <a href="paciente?idPessoa=<?= $usuario['idPessoa'] ?>" id="div_login">
            <?php endif; ?>
                <button tabindex="-1" class="btn_padrao">Meu Perfil</button>
            </a>
            <a href="javascript:dialog()"><button tabindex="-1" class="btn_padrao cancelar">Sair da Conta</button></a>
        </div>
    </div>
</nav>


<div id="menu">
    <div id="barra_menu">
        <div id="btn_menu">
            <i class="bi bi-x"></i>
        </div>

        <?php if ($usuario['tipoPessoa'] != 'user' && $usuario['tipoPessoa'] != '') : ?>
            <a href="funcionario?idPessoa=<?= $usuario['idPessoa'] ?>" id="div_login">
        <?php elseif ($usuario['tipoPessoa'] == 'user' && $_SESSION['nomePessoa'] != 'Faça Login') : ?>
            <a href="paciente?idPessoa=<?= $usuario['idPessoa'] ?>" id="div_login">
        <?php else : ?>
            <a href="login" id="div_login">
        <?php endif; ?>
                    <!-- <img  id="foto_login" src="../img/foto_paciente.jpg" alt=""> -->
        <div id="div_login">
            <?php if ($usuario['arquivoPerfil'] != '') : ?>
                <img id="foto_login" src="../upload/perfil/<?= $usuario['arquivoPerfil'] ?>" alt="">
            <?php else : ?>
                <img id="foto_login" src="../upload/perfil/perfilPadrao.jpg" alt="">
            <?php endif; ?>
            <p id="nome_login">Olá, <?= $_SESSION['nomePessoa'] ?></p>
        </div></a>

        <div id="tema">
            <p>Tema</p>
            <div class="theme-container shadow-dark">
                <img id="theme-icon" src="https://www.uplooder.net/img/image/2/addf703a24a12d030968858e0879b11e/moon.svg" alt="Ícone de tema">
            </div>
        </div>
        <?php if ($_SESSION['OP'] != 'user' and $_SESSION['nomePessoa'] != '') : 
            ?>
            <div id="div_links">
                <a href="index.php">
                    <p>Home</p>
                </a>
                <a href="pacientes.php">
                    <p>Pacientes</p>
                </a>
                <a href="funcionarios.php">
                    <p>Funcionários</p>
                </a>
                <a href="unidades.php">
                    <p>Unidades</p>
                </a>
            </div>
        <?php endif; ?>
        <a href="alterarSenha.php?idPessoa=<?= $usuario['idPessoa'] ?>"><button class="btn_padrao">Alterar Senha</button></a>
        <a href="javascript:dialog()"><button class="btn_padrao cancelar">Sair da Conta</button></a>
    </div>
</div>

<dialog class="dialogo">
    <div id="div_dialogo">
        <p>Tem certeza que deseja sair?</p>
        <div class="div_botoes">
            <button id="cancelar" class="btn_padrao cancelar">Cancelar</button>
            <a href="logout"><button id="confirmar" class="btn_padrao">Confirmar</button></a>
        </div>
    </div>
</dialog>