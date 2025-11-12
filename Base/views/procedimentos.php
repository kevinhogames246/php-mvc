<?php
session_start();
require_once '../config/db.php'; 
require_once '../controllers/AuthController.php';


$authController = new AuthController($db);

if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
}

$usuario = $authController->getPessoaByEmail($_SESSION['emailPessoa']);

$action = $_GET['action'] ?? '';
$idPessoaMudar = $_GET['idPessoaMudar'] ?? '';
$vaiPra = $_GET['vaiPra'] ?? '';

if ($action === 'registerProcedimento' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeProcedimento = $_POST['nomeProcedimento'];
    $descProcedimento = $_POST['descProcedimento'];

    $authController->registerProcedimento($nomeProcedimento, $descProcedimento);
    
    exit;
}

if ($action === 'updateProcedimento' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $nomeProcedimento = $_POST['nomeProcedimento'];
    $descProcedimento = $_POST['descProcedimento'];

    $authController->updateProcedimento($nomeProcedimento, $descProcedimento);
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/estilo-basico.css">
    <link rel="stylesheet" href="../css/components/botao.css">
    <link rel="stylesheet" href="../css/components/inputs.css">
    <link rel="stylesheet" href="../css/components/tabela.css">
    <link rel="stylesheet" href="../css/components/botao_voltar.css">
    <title>Health Track</title>

</head>
<body>
    <?php include '../components/nav.php'; ?>

    <?php if ($usuario['tipoPessoa'] === 'admin'): 
        
        
        ?>
        
        <a href="dashboard.php">
            <div id="seta_voltar">
                <i class="bi bi-chevron-left" style="font-size: 28px"></i>
            </div>
        </a>

        <h3 id="titulo">procedimentos</h3>
        
        
        <div id="div_pesq_cadastro">       
            <a href="procedimentoCadastraEdita.php">
                <button class="btn_padrao">Cadastrar</button>
            </a>

            <!-- 
                Pegar todos os itens de paciente e colocar em um json, filtrar pelo js usando a função, onKeyUp=""
             -->
            <form class="forms" action="">
                <div class="label-float">
                    <input onKeyUp="" name="paciente" placeholder=" " type="text">
                    <label for="paciente">Buscar Paciente</label>
                    <button id="btn_lupa"><i class="bi bi-search" style="font-size: 22px; margin-left: 8px;"></i></button>
                </div>
            </form>
        </div>

        <div id="table-container">
            <table>
                <tbody>    
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>

                    <?php
                        $procedimentos = $authController->getAllProcedimentos();
                    
                        foreach ($procedimentos as $procedimento): ?>
                            <tr>
                                <td><?= $procedimento['nomeProcedimento'] ?></td>
                                <td><?= $procedimento['descProcedimento'] ?></td>
                                <td><a href="procedimentoCadastraEdita.php?idProcedimento=<?= $procedimento['idProcedimento'] ?>"><img src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>
                                <td><a href="../models/delete_procedimento.php?idProcedimento=<?= $procedimento['idProcedimento'] ?>" ><img src="../img/logo_excluir.png" width="27.5px" height="34px" alt="lixeira" srcset=""></a></td>
                            </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>                    

        <footer>
        <p style="margin: 0;"> Health Track - 2023</p>
        <p style="margin: 0;">TCC - Informatica para internet</p>
        <p style="margin: 0;">Kevin, Mariana e Mateus</p>
        </footer> 
        
    <?php elseif ($usuario['tipoPessoa'] === 'user'): header('Location: paciente.php');?>
        
    <?php else: ?>
        <h1 id="titulo">Erro 404</h1>
        <!-- Conteúdo específico para Usuários -->
    <?php endif; ?>

    <script src="../js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
