<?php
    session_start();
    require_once '../config/db.php'; 
    require_once '../controllers/authController.php';


    // echo '<script>alert("login")</script>';

    $authController = new authController($db);

    $usuario = $authController->getPessoaById($_SESSION['idPessoa']);
    $action = $_POST['action'] ?? '';
    $vemDe = $_GET['vemDe'] ?? '';


    if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../components/head.php'; ?>
    <head>
        <link rel="stylesheet" href="../css/estilo-detalhes.css">
    </head>
    <body>

        <?php if ($usuario['tipoPessoa'] === 'admin'): ?>
        
            <?php include '../components/nav.php'; ?>

            <a href="processoEdita.php?protocoloProcesso=<?= $vemDe ?>">
                <div id="seta_voltar">
                    <i class="bi bi-chevron-left" style="font-size: 28px"></i>
                </div>
            </a>
            <?php                 
                if (isset($_GET['idProcedimento'])):
                    $idProcedimento = $_GET['idProcedimento'];
                    $procedimento = $authController->getProcedimentoById($idProcedimento);
                else:
                    echo "Usuário não especificado.";
                    exit;
                endif;
                ?>
                  
            <div style="margin: 100px 0 100px 0;">
                <h3 id="titulo" style="margin: 0;">Detalhes do Procedimento</h3>

                <div id="div_detalhes_proc">
                    <div id="texto_detalhes">
                        <p><b>Procedimento:</b><br><?= $procedimento['nomeProcedimento'] ?> </p>
                        <p><b>Estado do paciente:</b><br><?= ($procedimento['statusHistorico'] != '') ? $procedimento['statusHistorico'] : 'Não avaliado' ?> </p>
                        <p><b>Funcionário Responsável:</b><br><?= $procedimento['nomePessoa'] ?> </p>
                        <p><b>Cargo do Funcionário:</b><br><?= $procedimento['cargoFuncionario'] ?> </p>
                        <?php if (isset($procedimento['idEspecialidade'])): ?>
                            <p><b>Especialidade do Funcionário:</b><br><?= $procedimento['nomeEspecialidade'] ?> </p>
                        <?php endif ?>
                        <?php if (isset($procedimento['idUniSaude'])): ?>
                            <p><b>Unidade de Saúde:</b><br><?= $procedimento['nomeUniSaude'] ?> </p>
                            <p><b>Endereço da Unidade:</b><br><?= $procedimento['enderecoUniSaude'] ?> </p>
                            <p><b>Cidade:</b><br><?= $procedimento['nomeCidade'] ?> </p>
                            <p><b>Estado:</b><br><?= $procedimento['ufEstado'] ?> </p>
                        <?php endif ?>
                            <p><b>Observações médicas:</b><br><?= ($procedimento['obsMedicas'] != '') ? $procedimento['obsMedicas'] : 'Nenhuma' ?> </p>
                            <p><b>Medicamento(s) prescrito(s):</b><br><?=($procedimento['remedioProcedimento'] != '') ? $procedimento['remedioProcedimento'] : 'Nenhum' ?> </p>
                        <?php if (isset($procedimento['idExame'])): ?>
                            <p><b>Exame:</b><br><?= $procedimento['nomeExame'] ?> </p>
                            <p><b>Data do exame:</b><br><?= $procedimento['dataExame'] ?> </p>
                            <p><b>Unidade do exame realizado:</b><br><?= $procedimento['unidadeExame'] ?> </p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            

        <?php elseif ($usuario['tipoPessoa'] === 'user'): 
            if (isset($_SESSION['idPessoa'])) { 
                header('Location: paciente.php?idPessoa=' . $_SESSION['idPessoa']); exit;
            };
            ?>
        <?php else: header('Location: login.php');?>

        <?php endif;?>

        
        <script src="../js/bootstrap.bundle.js" ></script>
        <script src="../js/bootstrap.bundle.min.js"></script>
        <script src="../js/bootstrap.esm.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/javascript.js"></script>
    </body>
</html>
