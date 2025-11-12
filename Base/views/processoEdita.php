<?php
session_start();
require_once '../config/db.php';
require_once '../controllers/AuthController.php';


$authController = new AuthController($db);


if (!isset($_SESSION['nomePessoa'])) {
    header('Location: index.php');
}
unset($_SESSION['formProcedimento']);

if ($_SESSION['nomePessoa'] != "Faça Login") {
    $tipoPessoa = $authController->getPessoaTipo($_SESSION['emailPessoa']);
    // $usuario = $authController->getPessoaByEmail($_SESSION['emailPessoa']);
    $usuario = $authController->getFuncionarioByPessoa($_SESSION['idPessoa']);
} else {
    // $_SESSION['nomePessoa'] = "Faça Login";
    $_SESSION['OP'] = 'user';
    $usuario['tipoPessoa'] = 'user';
    $usuario['idPessoa'] = 0;
    // $usuario['tipoPessoa'] = ''; 
    $usuario['arquivoPerfil'] = '';
}

// $action = $_GET['action'] ?? '';
$vemDe = $_GET['vemDe'] ?? 'index';
$idPessoa = $_GET['idPessoa'] ?? '';

$authController = new AuthController($db);
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php'; ?>

<head>

    <link rel="stylesheet" href="../css/estilo-<?= ($usuario['tipoPessoa'] === 'admin') ? 'processoEdita' : 'consulta'; ?>.css">
</head>

<body>
    <?php include '../Components/nav.php' ?>

    <?php if ($usuario['tipoPessoa'] === 'admin') : ?>
        <a href="javascript:btn_voltar()">
            <div id="seta_voltar">
                <i class="bi bi-chevron-left"></i>
            </div>
        </a>
    <?php endif; ?>

    <?php if ($_SESSION['OP'] === 'admin' or $_SESSION['OP'] === 'user') :
        if (isset($_GET['protocoloProcesso']) and $_GET['protocoloProcesso'] != '') {
            $protocoloProcesso = $_GET['protocoloProcesso'];
            $processo = $authController->getProcessoByProtocolo($protocoloProcesso);
            if ($processo == false) {
                echo "<script>window.location.href='../controllers/return.php?tipo=x&mensagem=Processo $protocoloProcesso não exixte!&destino=../views/index.php';</script>";
            }
            // echo "<script>alert('" . $processo['idProcesso'] . "')</script>";
        } else {
            echo "<script>window.location.href='../controllers/return.php?tipo=x&mensagem=Processo não exixte!&destino=../views/login.php';</script>";
            exit;
        };
        $retVal = ($usuario['tipoPessoa'] === 'admin') ? 'pessoa' : 'paciente';

    ?>
        <div id="div_dados_<?= $retVal ?>">
            <?php if ($processo['arquivoPerfil'] != '') : ?>
                <img id="foto_<?= $retVal ?>" src="../upload/perfil/<?= $processo['arquivoPerfil'] ?>" alt="">
            <?php else : ?>
                <img id="foto_<?= $retVal ?>" src="../upload/perfil/perfilPadrao.jpg" alt="">
            <?php endif; ?>
            <!-- <img id="foto_<?= $retVal ?>" src="../img/Usuario.png" alt=""> -->
            <?php if ($usuario['tipoPessoa'] === 'admin') : ?>
                <h4>Dados do Paciente</h4>
            <?php endif; ?>
            <div id="dados_<?= $retVal ?>" style="display: block;">
                <?php if ($usuario['tipoPessoa'] != 'admin') : ?>
                    <h4>Dados do Paciente</h4>
                <?php endif; ?>
                <p>Nome: <?= $processo['nomePessoa'] ?></p>
                <p>Código de acompanhamento: <?= $processo['protocoloProcesso'] ?></p>
                <p>Gravidade Clínica: <?= $processo['statusPaciente'] ?></p>
                <?php if ($usuario['tipoPessoa'] === 'admin' or $usuario['idPessoa'] === $processo['idPessoa']) : ?>
                    <p>Cpf: <?= $processo['cpfPessoa'] ?></p>
                    <p>Data de Nascimento: <?= date('d/m/Y', strtotime($processo['dataNascPessoa'])) ?></p>
                    <p>Email: <?= $processo['emailPessoa'] ?> </p>
                    <p>Endereço: <?= $processo['enderecoPessoa'] ?></p>
                    <p>Telefone: <?= $processo['telPessoa'] ?></p>
                    <p>Telefone de Emergencia: <?= $processo['telEmergenciaPaciente'] ?></p>
                    <p>Alergias: <?= $processo['alergiaPaciente'] ?></p>
                    <p>Doenças Geneticas: <?= $processo['doencaGeneticaPaciente'] ?></p>
                <?php endif; ?>
            </div>
        </div>

        <h3 id="titulo">Processo do Paciente</h3>

        <div id="processo_paciente">
            <div id="linha">
                <div id="itens">
                    <?php
                    $procedimentos = $authController->getAllProcedimentosByProcesso($processo['protocoloProcesso']);
                    function compareDataHora($a, $b)
                    {
                        return strtotime($a['dataHoraProcedimento']) - strtotime($b['dataHoraProcedimento']);
                    }

                    // Ordenar o array usando a função de comparação
                    usort($procedimentos, 'compareDataHora');

                    foreach ($procedimentos as $procedimento) :
                        // echo "<script>alert('" . $procedimento['idProcessoProc'] . "')</script>";
                    ?>
                        <div class="item">
                            <?php if ($usuario['tipoPessoa'] === 'admin') : ?>
                                <a href="../controllers/DelController.php?tabela=procedimento&idExcluir=<?= $procedimento['idProcedimento'] ?>&vemDe=<?= $protocoloProcesso ?>">
                                    <button id="btn_excluir"><img src="../img/logo_excluir.png" width="36.66px" height="45.33px" alt="" srcset=""></button>
                                </a>
                            <?php endif; ?>
                            <div class="circulo">
                                <?php if ($procedimento['iconeProcedimento'] != '') : ?>
                                    <i class="bi <?= $procedimento['iconeProcedimento'] ?>"></i>
                                <?php else : ?>
                                    <i class="bi bi-hospital"></i>
                                <?php endif; ?>

                            </div>
                            <div class="texto_circulo">
                                <p><?= $procedimento['nomeProcedimento'] ?></p>
                                <p><?= date('d/m/Y - H:i', strtotime($procedimento['dataHoraProcedimento'])) ?></p>
                                <p><?= $procedimento['nomeUniSaude'] ?></p>
                                <a href="detalhes?idProcedimento=<?= $procedimento['idProcedimento'] ?>&vemDe=<?= $protocoloProcesso ?>">
                                    <button class="btn_detalhes"><i class="bi bi-plus-circle" style="font-size: 26px; margin-right: 6px;"></i>Detalhes</button>
                                </a>
                            </div>
                            <?php if ($usuario['tipoPessoa'] === 'admin') : ?>
                                <a href="procedimentoCadastraEdita.php?idProcedimento=<?= $procedimento['idProcedimento'] ?>&vemDe=<?= $protocoloProcesso ?>">
                                    <button id="btn_editar"><img src="../img/logo_editar.png" width="41.33px" height="40.33px" alt="" srcset=""></button>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>



        <?php if ($usuario['tipoPessoa'] === 'admin' and end($procedimentos)['nomeProcedimento'] != 'Saida da unidade') : ?>
            <a href="procedimentoCadastraEdita.php?vemDe=<?= $protocoloProcesso ?>&idProcesso=<?= $processo['idProcesso'] ?>">
                <button tabindex="-1" class="btn_padrao btn_add"><i class="bi bi-clipboard2-plus" id="icon_btn_proc"></i>
                    <p>Procedimento</p>
                </button>
            </a>
            <a style="margin: 0 auto 50px auto;">
                <button tabindex="-1" onclick="finalizaProcesso(<?= $processo['idProcesso'] ?>, <?= $usuario['idFuncionario'] ?>)" class="btn_padrao">Finalizar Processo</button>
            </a>
        <?php endif; ?>

    <?php else : header('Location: index.php'); ?>
    <?php endif; ?>

    <?php include '../components/footer.php'; ?>
    <?php include '../components/notificacao.php'; ?>

    <!-- <a href="logout.php">Logout</a> -->
    <script src="../js/javascript.js"></script>
    <!-- <script src="../js/mensagens.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>