<?php
session_start();
require_once '../config/db.php';
// require_once '../controllers/PessoaController.php';
require_once '../controllers/AuthController.php';
// require_once dirname(__FILE__) . '/../models/Users.php';
require_once dirname(__FILE__) . '/../models/Pessoas.php';
require_once '../models/Processos.php';
require_once '../models/Pacientes.php';


$authController = new AuthController($db);

if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
}

$tipoPessoa = $authController->getPessoaTipo($_SESSION['emailPessoa']);
$usuario = $authController->getPessoaById($_SESSION['idPessoa']);

$vaiPra = $_GET['vaiPra'] ?? '';
$action = $_GET['action'] ?? '';

// echo '<br>' . $_SESSION['tipoPessoa'] . "foi";
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php'; ?>

<body>
    <?php include '../components/nav.php'; ?>

    <?php if ($usuario['tipoPessoa'] === 'admin') : ?>
        <a href="pacientes.php?">
            <div id="seta_voltar">
                <i class="bi bi-chevron-left" style="font-size: 28px"></i>
            </div>
        </a>
    <?php endif; ?>

    <?php if ($usuario['tipoPessoa'] === 'admin' or $usuario['tipoPessoa'] === 'user') :
        if (isset($_GET['idPessoa'])) :
            $idPessoa = $_GET['idPessoa'];
            $pessoa = $authController->getPacienteByPessoa($idPessoa);
        elseif ($usuario['tipoPessoa'] === 'user') :
            $pessoa = $authController->getPacienteByPessoa($_SESSION['idPessoa']);
        endif;
    ?>
        <?php if ($usuario['tipoPessoa'] === 'user') : ?>
            <div id="div_bemvindo">
                <h1>Olá <span> <?= $_SESSION['nomePessoa'] ?></span>,<br>Bem vindo ao<br>Health Track.</h1>
                <img src="../img/imagem bemvindo.jpg" alt="" srcset="">
            </div>
        <?php endif; ?>

        <div id="div_dados_pessoa">
            <?php if ($pessoa['arquivoPerfil'] != '') : ?>
                <img id="foto_pessoa" src="../upload/perfil/<?= $pessoa['arquivoPerfil'] ?>" alt="">
            <?php else : ?>
                <img id="foto_pessoa" src="../upload/perfil/perfilPadrao.jpg" alt="">
            <?php endif; ?>
            <h4>Dados do Paciente</h4>

            <div id="dados_pessoa" style="display: block;">
                <p>Nome: <?= $pessoa['nomePessoa'] ?></p>
                <p>Cpf: <?= $pessoa['cpfPessoa'] ?></p>
                <p>Data de Nascimento: <?= ($pessoa['dataNascPessoa'] != '') ? date('d/m/Y', strtotime($pessoa['dataNascPessoa'])) : '' ?></p>
                <p>Email: <?= $pessoa['emailPessoa'] ?></p>
                <p>Endereço: <?= $pessoa['enderecoPessoa'] ?>, <?= $pessoa['nomeCidade'] ?>-<?= $pessoa['ufEstado'] ?></p>
                <!-- <?php if (isset($pessoa['nomeCidade'])) : ?>    
                    <p>Cidade: <?= $pessoa['nomeCidade'] ?></p>
                <?php endif; ?> -->
                <p>Telefone: <?= $pessoa['telPessoa'] ?></p>
                <p>Telefone de Emergencia: <?= $pessoa['telEmergenciaPaciente'] ?></p>
                <p>Alergias: <?= $pessoa['alergiaPaciente'] ?></p>
                <p>Doenças Geneticas: <?= $pessoa['doencaGeneticaPaciente'] ?></p>
            </div>
        </div>


        <?php if ($usuario['tipoPessoa'] === 'admin') : ?>
                <div style="display: flex; justify-content: center;">
                    <a href="alterarSenha.php?idPessoa=<?= $idPessoa ?>"><button style="margin-top: 15px;" class="btn_padrao">Alterar Senha</button></a>
                </div>
                <h3 id="titulo">Processos do Paciente</h3>
        <?php else : ?>
            <h3 id="titulo">Seus processos</h3>
        <?php endif; ?>


        <div id="table-container">
            <table>
                <tbody>
                    <tr>
                        <th>Protocolo</th>
                        <th>Data de Inicio</th>
                        <th>Data Final</th>
                        <!-- <th>Unidade</th> -->
                        <th>Visualizar</th>
                        <?php if ($usuario['tipoPessoa'] === 'admin') : ?>
                            <!-- <th>Editar</th> -->
                            <th>Excluir</th>
                        <?php endif; ?>
                    </tr>

                    <?php
                    $processos = $authController->getAllProcessosByPaciente($pessoa['idPaciente']);

                    foreach ($processos as $processo) : ?>
                        <tr>
                            <td><?= $processo['protocoloProcesso'] ?></td>
                            <td><?= date('d/m/Y', strtotime($processo['dataInicialProcesso'])) ?></td>
                            <td><?= ($processo['dataFinalProcesso'] != '') ? date('d/m/Y', strtotime($processo['dataFinalProcesso'])) : '' ?></td>
                            <!-- <td><?= $processo['uniSaude'] ?></td> -->
                            <td><a href="processoEdita.php?protocoloProcesso=<?= $processo['protocoloProcesso'] ?>&idPessoa=<?= $idPessoa ?>&vemDe=paciente"><img src="../img/logo_visualizar.png" width="39.38px" height="39.38px" alt="" srcset=""></a></td>
                            <?php if ($usuario['tipoPessoa'] === 'admin') : ?>
                                <!-- <td><a href="processoCadastraEdita.html"><img src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td> -->
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

    <?php include '../components/footer.php'; ?>
    <?php include '../components/notificacao.php'; ?>

    <!-- <a href="logout.php">Logout</a> -->
    <script src="../js/bootstrap.bundle.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/bootstrap.esm.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/javascript.js"></script>
</body>

</html>