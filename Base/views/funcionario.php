<?php
session_start();
require_once '../config/db.php';
// require_once '../controllers/PessoaController.php';
require_once '../controllers/AuthController.php';
// require_once dirname(__FILE__) . '/../models/Users.php';
require_once dirname(__FILE__) . '/../models/Pessoas.php';
require_once '../models/Processos.php';
require_once '../models/Pacientes.php';

// echo '<script>alert("kevin")</script>';

$authController = new AuthController($db);

if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
}

$tipoPessoa = $authController->getPessoaTipo($_SESSION['emailPessoa']);

$usuario = $authController->getPessoaByEmail($_SESSION['emailPessoa']);

$vaiPra = $_GET['vaiPra'] ?? '';
$action = $_GET['action'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php' ?>

<body>

    <?php if ($usuario['tipoPessoa'] === 'admin') : ?>

        <?php include '../components/nav.php'; ?>

        <a href="pacientes.php?">
            <div id="seta_voltar">
                <i class="bi bi-chevron-left" style="font-size: 28px"></i>
            </div>
        </a>

        <?php if (isset($_GET['idPessoa'])) :
            $idPessoa = $_GET['idPessoa'];
            $pessoa = $authController->getFuncionarioByPessoa($idPessoa);
        elseif ($tipoPessoa === 'user') :
            $pessoa = $authController->getFuncionarioByPessoa($_SESSION['idPessoa']);
        else :
            echo "Usuário não especificado.";
            exit;
        endif;
        ?>

        <div id="div_dados_pessoa">
            <?php if ($pessoa['arquivoPerfil'] != '') : ?>
                <img id="foto_pessoa" src="../upload/perfil/<?= $pessoa['arquivoPerfil'] ?>" alt="">
            <?php else : ?>
                <img id="foto_pessoa" src="../upload/perfil/perfilPadrao.jpg" alt="">
            <?php endif; ?>
            <h4>Dados do Funcionário</h4>

            <div id="dados_pessoa" style="display: block;">
                <p>Nome: <?= $pessoa['nomePessoa'] ?></p>
                <p>CPF: <?= $pessoa['cpfPessoa'] ?></p>
                <p>Cargo: <?= $pessoa['cargoFuncionario'] ?></p>
                <p>Data de Nascimento: <?= ($pessoa['dataNascPessoa'] != '') ? date('d/m/Y', strtotime($pessoa['dataNascPessoa'])) : '' ?></p>
                <p>Email: <?= $pessoa['emailPessoa'] ?></p>
                <p>Endereço: <?= $pessoa['enderecoPessoa'] ?></p>
                <p>Telefone: <?= $pessoa['telPessoa'] ?></p>
            </div>
        </div>

    <?php if ($usuario['tipoPessoa'] === 'admin' or $usuario['idPessoa'] == $pessoa['idPessoa']) : ?>
        <div style="display: flex; justify-content: center;">
            <?php if ($usuario['idPessoa'] == $pessoa['idPessoa']) : ?>
                <a href="logout.php"><button onclick="dialog()" style="margin: 15px 20px 0 0;" class="btn_padrao cancelar">Sair da Conta</button></a>
                <?php endif; ?>
            <a href="alterarSenha.php?idPessoa=<?= $idPessoa ?>"><button style="margin-top: 15px;" class="btn_padrao">Alterar Senha</button></a>
        </div>
        <?php if ($usuario['idPessoa'] == $pessoa['idPessoa']) : ?>
            <h3 id="titulo">Seus processos</h3>
        <?php endif; ?>
    <?php else : ?>
        <h3 id="titulo">Processos com este funcionário</h3>
    <?php endif; ?>



    <div id="table-container">
        <table>
            <tbody>
                <tr>
                    <th>Processo</th>
                    <th>Paciente</th>
                    <th>Data Inicial</th>
                    <th>Data Final</th>
                    <th>Visualizar</th>
                    <?php if ($tipoPessoa === 'admin') : ?>
                        <th>Editar</th>
                        <th>Excluir</th>
                    <?php endif; ?>
                </tr>
                <?php
                $processos = $authController->getAllProcessosByFuncionario($pessoa['idFuncionario']);

                foreach ($processos as $processo) : ?>
                    <tr>
                        <td><?= $processo['protocoloProcesso'] ?></td>
                        <td><?= $processo['nomePessoa'] ?></td>
                        <td><?= ($processo['dataInicialProcesso'] != '') ? date('d/m/Y', strtotime($processo['dataInicialProcesso'])) : '' ?></td>
                        <td><?= ($processo['dataFinalProcesso'] != '') ? date('d/m/Y', strtotime($processo['dataFinalProcesso'])) : '' ?></td>
                        <td><a href="processoEdita.php?protocoloProcesso=<?= $processo['protocoloProcesso'] ?>&idPessoa=<?= $idPessoa ?>&vemDe=paciente"><img src="../img/logo_visualizar.png" width="39.38px" height="39.38px" alt="" srcset=""></a></td>
                        <?php if ($tipoPessoa === 'admin') : ?>
                            <td><a href="processoCadastraEdita.html"><img src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>
                            <td><a href="../models/delete_user.php?emailPessoa=<?= $pessoa['emailPessoa'] ?>"><img src="../img/logo_excluir.png" width="27.5px" height="34px" alt="lixeira" srcset=""></a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php else : ?>
    <h1 id="titulo">Erro 404</h1>
    <!-- Conteúdo específico para quem não loga -->
<?php endif; ?>

<footer>
    <p style="margin: 0;"> Health Track - 2023</p>
    <p style="margin: 0;">TCC - Informatica para internet</p>
    <p style="margin: 0;">Kevin, Mariana e Mateus</p>
</footer>

<dialog class="dialogo">
    <div id="div_dialogo">
        <p>Tem certeza que deseja sair?</p>
        <div class="div_botoes">
            <button id="cancelar" class="btn_padrao cancelar">Cancelar</button>
            <a href="logout.php"><button id="confirmar" class="btn_padrao">Confirmar</button></a>
        </div>
    </div>
</dialog>

<!-- <a href="logout.php">Logout</a> -->
<script src="../js/bootstrap.bundle.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/bootstrap.esm.js"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/javascript.js"></script>
</body>

</html>