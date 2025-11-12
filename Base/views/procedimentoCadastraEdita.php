<?php
session_start();
require_once '../config/db.php';
require_once '../controllers/AuthController.php';

$authController = new AuthController($db);

if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
}

// unset($_SESSION['formProcedimento']);

$usuario = $authController->getFuncionarioByPessoa($_SESSION['idPessoa']);

$vemDe = $_GET['vemDe'] ?? '';
$idProcesso = $_GET['idProcesso'] ?? '';
if (isset($_GET['idProcedimento'])) :
    $idProcedimento = $_GET['idProcedimento'];
    $procedimento = $authController->getProcedimentoById($idProcedimento);
endif;


$fusoHorario = new DateTimeZone('America/Sao_Paulo');
$dataHoraAtual = new DateTime('now', $fusoHorario);
$formato = 'Y-m-d H:i:s';
$dataHoraProcedimento = $dataHoraAtual->format($formato);
$_SESSION['formProcedimento']['nomeProcedimento'] = $_SESSION['formProcedimento']['nomeProcedimento'] ?? $procedimento['nomeProcedimento'] ?? '';
$_SESSION['formProcedimento']['descProcedimento'] = $_SESSION['formProcedimento']['descProcedimento'] ?? $procedimento['descProcedimento'] ?? '';
$_SESSION['formProcedimento']['dataHoraProcedimento'] = $_SESSION['formProcedimento']['dataHoraProcedimento'] ?? $procedimento['dataHoraProcedimento'] ?? $dataHoraProcedimento;
// echo $procedimento['dataHoraProcedimento'];
$_SESSION['formProcedimento']['statusHistorico'] = $_SESSION['formProcedimento']['statusHistorico'] ?? $procedimento['statusHistorico'] ?? '';
$_SESSION['formProcedimento']['iconeProcedimento'] = $_SESSION['formProcedimento']['iconeProcedimento'] ?? $procedimento['iconeProcedimento'] ?? 'bi-hospital';
$_SESSION['formProcedimento']['fk_idFuncionario'] = $_GET['idFuncionario'] ?? ($_SESSION['formProcedimento']['fk_idFuncionario'] ?? ($procedimento['fk_idFuncionario'] ?? $usuario['idFuncionario']));
$funcionario = $authController->getFuncionarioById($_SESSION['formProcedimento']['fk_idFuncionario']);
$nomeFuncionario = $funcionario['nomePessoa'] ?? '';
$_SESSION['formProcedimento']['fk_idUniSaude'] = $_GET['idUniSaude'] ?? ($_SESSION['formProcedimento']['fk_idUniSaude'] ?? $procedimento['fk_idUniSaude'] ?? '');
$_SESSION['formProcedimento']['fk_idUniSaude'] = $_GET['idUniSaude'] ?? $_SESSION['formProcedimento']['fk_idUniSaude'] ?? $procedimento[''];
$uniSaude = $authController->getUnidadeById($_SESSION['formProcedimento']['fk_idUniSaude']);
$nomeUniSaude = $uniSaude['nomeUniSaude'] ?? '';
$_SESSION['formProcedimento']['arquivoExame'] = $_SESSION['formProcedimento']['arquivoExame'] ?? $procedimento['nomeExame'] ?? '';
$_SESSION['formProcedimento']['nomeExame'] = $_SESSION['formProcedimento']['nomeExame'] ?? $procedimento['nomeExame'] ?? '';
$_SESSION['formProcedimento']['dataExame'] = $_SESSION['formProcedimento']['dataExame'] ?? $procedimento['dataExame'] ?? '';
$_SESSION['formProcedimento']['unidadeExame'] = $_SESSION['formProcedimento']['unidadeExame'] ?? $procedimento['unidadeExame'] ?? '';
$_SESSION['formProcedimento']['remedioProcedimento'] = $_SESSION['formProcedimento']['remedioProcedimento'] ?? $procedimento['remedioProcedimento'] ?? '';
$_SESSION['formProcedimento']['obsMedicas'] = $_SESSION['formProcedimento']['obsMedicas'] ?? $procedimento['obsMedicas'] ?? '';
$usuario = $authController->getPessoaById($_SESSION['idPessoa']);
$funcionarios = $authController->getAllFuncionarios();
?>

<!DOCTYPE html>
<html lang="pt-br">

<?php include '../components/head.php'; ?>

<head>
    <link rel="stylesheet" href="../css/estilo-cadastraEdita3.css">
</head>

<body>
    <?php include '../components/nav.php'; ?>

    <a href="processoEdita.php?protocoloProcesso=<?= $vemDe ?>">
        <div id="seta_voltar">
            <i class="bi bi-chevron-left" style="font-size: 28px"></i>
        </div>
    </a>

    <?php if ($usuario['tipoPessoa'] === 'admin') :
        if (isset($_GET['idProcedimento'])) :
            $idProcedimento = $_GET['idProcedimento'];
            $procedimento = $authController->getProcedimentoById($idProcedimento);

    ?>
            <h3 id="titulo">Editar Procedimento</h3>
            <form class="forms" action="../controllers/UpdateController.php?tabela=procedimento&idUpdate=<?= $procedimento['idProcedimento'] ?>&vemDe=<?= $vemDe ?>" method="POST" id="meuFormulario" enctype="multipart/form-data">

                <input type="hidden" name="vemDe" value="<?= $vemDe ?>">
                <input type="hidden" name="idUpdate" value="<?= $idProcesso ?>">
                <input type="hidden" name="destino" id="campoDestino" value="">

                <div id="colunas">
                    <div id="coluna1">
                        <div class="label-float">
                            <input type="text" maxlength="80" name="nomeProcedimento" id="nomeProcedimento" placeholder=" " value="<?= $_SESSION['formProcedimento']['nomeProcedimento'] ?? $procedimento['nomeProcedimento'] ?>">
                            <label for="nomeProcedimento">Nome do Procedimento:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" name="descProcedimento" id="descProcedimento" placeholder=" " value="<?= $_SESSION['formProcedimento']['descProcedimento'] ?? $procedimento['desc'] ?>">
                            <label for="descProcedimento">Descrição do Procedimento:</label>
                        </div>
                        <div class="label-float">
                        <input type="datetime-local" name="dataHoraProcedimento" value="<?= $_SESSION['formProcedimento']['dataHoraProcedimento'] ?? '' ?>" />
                            <!-- <input type="date" name="dataHoraProcedimento" value="<?= $_SESSION['formProcedimento']['dataHoraProcedimento'] ?? '' ?>"> -->
                            <label for="dataHoraProcedimento">Data e Hora do Procedimento:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" name="statusHistorico" id="statusHistorico" placeholder=" " value="<?= $_SESSION['formProcedimento']['statusHistorico'] ?? $procedimento[''] ?>">
                            <label for="statusHistorico">Estado de Saúde do Paciente:</label>
                        </div>
                        <div id="div_icone">
                            <select id="select" name="iconeProcedimento" class="select" onchange="mudarIcone()">
                                <option value="bi-hospital" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-hospital') ? 'selected' : 'selected' ?>>Padrão</option>
                                <option value="bi-lamp-fill" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-lamp-fill') ? 'selected' : '' ?>>Abajur</option>
                                <option value="bi-file-earmark-text" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-file-earmark-text') ? 'selected' : '' ?>>Arquivo</option>
                                <option value="bi-bandaid" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-bandaid') ? 'selected' : '' ?>>Bandaid</option>
                                <option value="bi-calendar-heart" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-calendar-heart') ? 'selected' : '' ?>>Calendário</option>
                                <option value="bi-pen" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-pen') ? 'selected' : '' ?>>Caneta</option>
                                <option value="bi-house-heart-fill" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-house-heart-fill') ? 'selected' : '' ?>>Casa</option>
                                <option value="bi-paperclip" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-paperclip') ? 'selected' : '' ?>>Clipe</option>
                                <option value="bi-capsule" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-capsule') ? 'selected' : '' ?>>Comprimido</option>
                                <option value="bi-heart-pulse" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-heart-pulse') ? 'selected' : '' ?>>Coração</option>
                                <option value="bi-cash-coin" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-cash-coin') ? 'selected' : '' ?>>Dinheiro</option>
                                <option value="bi-envelope-paper-heart-fill" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-envelope-paper-heart-fill') ? 'selected' : '' ?>>Envelope</option>
                                <option value="bi-exclamation-circle" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-exclamation-circle') ? 'selected' : '' ?>>Exclamação</option>
                                <option value="bi-search" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-search') ? 'selected' : '' ?>>Lupa</option>
                                <option value="bi-megaphone" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-megaphone') ? 'selected' : '' ?>>Megafone</option>
                                <option value="bi-eye" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-eye') ? 'selected' : '' ?>>Olho</option>
                                <option value="bi-person" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-person') ? 'selected' : '' ?>>Pessoa</option>
                                <option value="bi-eyedropper" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-eyedropper') ? 'selected' : '' ?>>Pipeta</option>
                                <option value="bi-door-open" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-door-open') ? 'selected' : '' ?>>Porta</option>
                                <option value="bi-clipboard2-pulse-fill" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-clipboard2-pulse-fill') ? 'selected' : '' ?>>Prancehta</option>
                                <option value="bi-building" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-building') ? 'selected' : '' ?>>Prédio</option>
                                <option value="bi-lungs" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-lungs') ? 'selected' : '' ?>>Pulmão</option>
                                <option value="bi-radioactive" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-radioactive') ? 'selected' : '' ?>>Radiação</option>
                                <option value="bi-clock" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-clock') ? 'selected' : '' ?>>Relógio</option>
                                <option value="bi-prescription2" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-prescription2') ? 'selected' : '' ?>>Remédio</option>
                                <option value="bi-box-arrow-in-right" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-box-arrow-in-right') ? 'selected' : '' ?>>Saída</option>
                                <option value="bi-arrow-right" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-arrow-right') ? 'selected' : '' ?>>Seta</option>
                                <option value="bi-telephone" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-telephone') ? 'selected' : '' ?>>Telefone</option>
                                <option value="bi-thermometer-half" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-thermometer-half') ? 'selected' : '' ?>>Termômetro</option>
                                <option value="bi-arrow-left-right" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-arrow-left-right') ? 'selected' : '' ?>>Tranferência</option>
                            </select>
                            <div class="circulo">
                                <i class="<?= $_SESSION['formProcedimento']['iconeProcedimento'] ?? 'bi-hospital' ?>" id="icone"></i>
                            </div>
                        </div>
                        <div id="campos_selecionar">
                            <div class="label-float">
                                <input tabindex="-1" type="text" name="nomeFuncionario" id="nomeFuncionario" placeholder=" " value="<?= $nomeFuncionario ?? '' ?>" readonly>
                                <input type="hidden" name="fk_idFuncionario" id="fk_idFuncionario" placeholder=" " value="<?= $_SESSION['formProcedimento']['fk_idFuncionario'] ?>">
                                <label for="nomeFuncionario">Funcionário Responsável:</label>
                                <button style="margin-left: 10px" name="destino" value="../views/escolherFuncionario.php" class="btn_padrao">Selecionar</button>
                            </div>
                            <div class="label-float">
                                <input tabindex="-1" type="teste" name="arquivoExame" id="arquivoExame" placeholder=" " value="<?= $_SESSION['formProcedimento']['arquivoExame'] ?? ' ' ?> " readonly>
                                <label for="arquivoExame">Arquivo do Exame:</label>
                                <button type="button" class="btn_padrao" id="btn_selecionar" onclick="selecionarArquivo()">Selecionar</button>
                                <input type="file" name="arquivoExame" id="selecionar_arquivo" accept="" style="display:none;" onchange="exibirImagemSelecionada()">

                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="label-float">
                            <input type="text" name="nomeExame" id="nomeExame" placeholder=" " value="<?= $_SESSION['formProcedimento']['nomeExame'] ?? '' ?>">
                            <label for="nomeExame">Nome do Exame:</label>
                        </div>
                        <div class="label-float">
                            <input type="date" name="dataExame" value="<?= $_SESSION['formProcedimento']['dataExame'] ?? '' ?>">
                            <label for="dataExame">Data do Exame:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" name="unidadeExame" id="unidadeExame" placeholder=" " value="<?= $_SESSION['formProcedimento']['unidadeExame'] ?? '' ?>">
                            <label for="unidadeExame">Unidade do Exame:</label>
                        </div>
                        <div class="label-float">
                            <textarea rows="5" name="remedioProcedimento" id="remedioProcedimento" placeholder=" "><?= $_SESSION['formProcedimento']['remedioProcedimento'] ?? '' ?></textarea>
                            <label for="remedioProcedimento">Medicamento(s) Prescrito(s):</label>
                        </div>
                        <div class="label-float">
                            <textarea rows="5" name="obsMedicas" id="obsMedicas" placeholder=" "><?= $_SESSION['formProcedimento']['obsMedicas'] ?? '' ?></textarea>
                            <label for="obsMedicas">Observações:</label>
                        </div>
                    </div>
                </div>

                <button style="margin: 45px" name="destino" value="" class="btn_padrao">Edita</button>
            </form>
        <?php else : ?>
            <h3 id="titulo">Cadastra Procedimento</h3>
            <!-- <form class="forms" action="../controllers/returnProcedimento.php" method="POST" id="meuFormulario" enctype="multipart/form-data"> -->
            <form class="forms" action="../controllers/CreateController.php?tabela=procedimento&idCrear=<?= $idProcesso ?>&vemDe=<?= $vemDe ?>" method="POST" id="meuFormulario" enctype="multipart/form-data">

                <input type="hidden" name="vemDe" value="<?= $vemDe ?>">
                <input type="hidden" name="idProcesso" value="<?= $idProcesso ?>">
                <input type="hidden" name="destino" id="campoDestino" value="">

                <div id="colunas">
                    <div id="coluna1">
                        <div class="label-float">
                            <input type="text" maxlength="80" name="nomeProcedimento" id="nomeProcedimento" placeholder=" " value="<?= $_SESSION['formProcedimento']['nomeProcedimento'] ?? '' ?>" required>
                            <label for="nomeProcedimento">Nome do Procedimento:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" name="descProcedimento" id="descProcedimento" placeholder=" " value="<?= $_SESSION['formProcedimento']['descProcedimento'] ?? '' ?>">
                            <label for="descProcedimento">Descrição do Procedimento:</label>
                        </div>
                        <div class="label-float">
                        <input type="datetime-local" name="dataHoraProcedimento" value="<?= $_SESSION['formProcedimento']['dataHoraProcedimento'] ?? '' ?>" />
                            <!-- <input type="date" name="dataHoraProcedimento" value="<?= $_SESSION['formProcedimento']['dataHoraProcedimento'] ?? '' ?>"> -->
                            <label for="dataHoraProcedimento">Data e Hora do Procedimento:</label>
                        </div>
                        
                        <div class="label-float">
                            <input type="text" name="statusHistorico" id="statusHistorico" placeholder=" " value="<?= $_SESSION['formProcedimento']['statusHistorico'] ?? '' ?>">
                            <label for="statusHistorico">Estado de Saúde do Paciente:</label>
                        </div>
                        <div id="div_icone">
                            <select id="select" name="iconeProcedimento" class="select" onchange="mudarIcone()">
                                <option value="bi-hospital" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-hospital') ? 'selected' : 'selected' ?>>Padrão</option>
                                <option value="bi-lamp-fill" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-lamp-fill') ? 'selected' : '' ?>>Abajur</option>
                                <option value="bi-file-earmark-text" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-file-earmark-text') ? 'selected' : '' ?>>Arquivo</option>
                                <option value="bi-bandaid" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-bandaid') ? 'selected' : '' ?>>Bandaid</option>
                                <option value="bi-calendar-heart" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-calendar-heart') ? 'selected' : '' ?>>Calendário</option>
                                <option value="bi-pen" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-pen') ? 'selected' : '' ?>>Caneta</option>
                                <option value="bi-house-heart-fill" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-house-heart-fill') ? 'selected' : '' ?>>Casa</option>
                                <option value="bi-paperclip" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-paperclip') ? 'selected' : '' ?>>Clipe</option>
                                <option value="bi-capsule" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-capsule') ? 'selected' : '' ?>>Comprimido</option>
                                <option value="bi-heart-pulse" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-heart-pulse') ? 'selected' : '' ?>>Coração</option>
                                <option value="bi-cash-coin" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-cash-coin') ? 'selected' : '' ?>>Dinheiro</option>
                                <option value="bi-envelope-paper-heart-fill" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-envelope-paper-heart-fill') ? 'selected' : '' ?>>Envelope</option>
                                <option value="bi-exclamation-circle" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-exclamation-circle') ? 'selected' : '' ?>>Exclamação</option>
                                <option value="bi-search" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-search') ? 'selected' : '' ?>>Lupa</option>
                                <option value="bi-megaphone" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-megaphone') ? 'selected' : '' ?>>Megafone</option>
                                <option value="bi-eye" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-eye') ? 'selected' : '' ?>>Olho</option>
                                <option value="bi-person" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-person') ? 'selected' : '' ?>>Pessoa</option>
                                <option value="bi-eyedropper" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-eyedropper') ? 'selected' : '' ?>>Pipeta</option>
                                <option value="bi-door-open" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-door-open') ? 'selected' : '' ?>>Porta</option>
                                <option value="bi-clipboard2-pulse-fill" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-clipboard2-pulse-fill') ? 'selected' : '' ?>>Prancehta</option>
                                <option value="bi-building" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-building') ? 'selected' : '' ?>>Prédio</option>
                                <option value="bi-lungs" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-lungs') ? 'selected' : '' ?>>Pulmão</option>
                                <option value="bi-radioactive" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-radioactive') ? 'selected' : '' ?>>Radiação</option>
                                <option value="bi-clock" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-clock') ? 'selected' : '' ?>>Relógio</option>
                                <option value="bi-prescription2" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-prescription2') ? 'selected' : '' ?>>Remédio</option>
                                <option value="bi-box-arrow-in-right" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-box-arrow-in-right') ? 'selected' : '' ?>>Saída</option>
                                <option value="bi-arrow-right" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-arrow-right') ? 'selected' : '' ?>>Seta</option>
                                <option value="bi-telephone" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-telephone') ? 'selected' : '' ?>>Telefone</option>
                                <option value="bi-thermometer-half" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-thermometer-half') ? 'selected' : '' ?>>Termômetro</option>
                                <option value="bi-arrow-left-right" <?= ($_SESSION['formProcedimento']['iconeProcedimento'] == 'bi-arrow-left-right') ? 'selected' : '' ?>>Tranferência</option>
                            </select>
                            <div class="circulo">
                                <i class="<?= $_SESSION['formProcedimento']['iconeProcedimento'] ?? 'bi-hospital' ?>" id="icone"></i>
                            </div>
                        </div>
                        <div id="campos_selecionar">
                            <div class="label-float">
                                <input type="hidden" name="fk_idFuncionario" id="fk_idFuncionario" placeholder=" " value="<?= $_SESSION['formProcedimento']['fk_idFuncionario'] ?>">
                                <input tabindex="-1" type="text" name="nomeFuncionario" id="nomeFuncionario" placeholder=" " value="<?= $nomeFuncionario ?? '' ?>" readonly>
                                <label for="nomeFuncionario">Funcionário Responsável:</label>
                                <button style="margin-left: 10px" name="destino" value="../views/escolherFuncionario.php" class="btn_padrao">Selecionar</button>
                            </div>
                            <div class="label-float">
                                <input tabindex="-1" type="teste" name="arquivoExame" id="arquivoExame" placeholder=" " value="<?= $_SESSION['formProcedimento']['arquivoExame'] ?? '' ?> " readonly>
                                <label for="arquivoExame">Arquivo do Exame:</label>
                                <button type="button" class="btn_padrao" id="btn_selecionar" onclick="selecionarArquivo()">Selecionar</button>
                                <input type="file" name="arquivoExame" id="selecionar_arquivo" accept="" style="display:none;" onchange="exibirImagemSelecionada()">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="label-float">
                            <input type="text" name="nomeExame" id="nomeExame" placeholder=" " value="<?= $_SESSION['formProcedimento']['nomeExame'] ?? '' ?>">
                            <label for="nomeExame">Nome do Exame:</label>
                        </div>
                        <div class="label-float">
                        <input type="date" name="dataExame" value="<?= $_SESSION['formProcedimento']['dataExame'] ?? '' ?>">
                            <!-- <input type="text" oninput="mascaraData(event)" name="dataExame" id="dataExame" placeholder=" " value="<?= $_SESSION['formProcedimento']['dataExame'] ?? '' ?>"> -->
                            <label for="dataExame">Data do Exame:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" name="unidadeExame" id="unidadeExame" placeholder=" " value="<?= $_SESSION['formProcedimento']['unidadeExame'] ?? '' ?>">
                            <label for="unidadeExame">Unidade do Exame:</label>
                        </div>
                        <div class="label-float">
                            <textarea rows="5" name="remedioProcedimento" id="remedioProcedimento" placeholder=" "><?= $_SESSION['formProcedimento']['remedioProcedimento'] ?? '' ?></textarea>
                            <label for="remedioProcedimento">Medicamento(s) Prescrito(s):</label>
                        </div>
                        <div class="label-float">
                            <textarea rows="5" name="obsMedicas" id="obsMedicas" placeholder=" "><?= $_SESSION['formProcedimento']['obsMedicas'] ?? '' ?></textarea>
                            <label for="obsMedicas">Observações:</label>
                        </div>
                    </div>
                </div>
                <button style="margin: 45px" name="destino" value="" class="btn_padrao" onclick="verificarCampoPreenchido()">Cadastrar</button>

            </form>

        <?php endif; ?>

    <?php elseif ($usuario['tipoPessoa'] === 'user') : header('Location: paciente.php'); ?>

    <?php else : ?>
        <h1 id="titulo">Erro 404</h1>
    <?php endif; ?>
    <?php include '../components/footer.php'; ?>

    <script src="../js/javascript.js"></script>
    <script>

        function selecionarArquivo() {
            document.getElementById('selecionar_arquivo').click();
        }

        function exibirImagemSelecionada() {
            var input = document.getElementById('selecionar_arquivo');
            var nomeExame = document.getElementById('arquivoExame');

            if (input.files && input.files[0]) {
                nomeExame.value = input.files[0].name;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>