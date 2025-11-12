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

    $idPessoa = $_GET['idPessoa'] ?? '';

    $tipoPessoa = $authController->getPessoaTipo($_SESSION['emailPessoa']);
    $usuario = $authController->getFuncionarioByPessoa($_SESSION['idPessoa']);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../components/head.php'; ?>
<body>
    <?php include '../components/nav.php'; ?>

    <a href="javascript:btn_voltar()">
        <div id="seta_voltar">
            <i class="bi bi-chevron-left"></i>
        </div>
    </a>
    
    <h3 id="titulo">Cadastrar Processo</h3>

    <div class="div_pesquisa">
        <form class="forms" action="">
            <div class="label-float">
                <input  name="busca" placeholder="" type="text">
                <label for="busca">Buscar Paciente</label>
                <button><i class="bi bi-search"></i></button>
            </div>
        </form>
    </div>

    <div id="table-container">
        <table>
            <tbody>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data Nasc.</th>
                    <th>Visualizar</th>
                    <th>Selecionar</th>
                </tr>
                <?php
                    $busca = $_GET["busca"] ?? '';
                 
                    $pacientes = $authController->getAllPacientes();
                    
                    if ($busca !== "") {
                        $busca = strtolower($busca);
                        $len = strlen($busca);
                        foreach($pacientes as $paciente) {
                            if (stristr($busca, substr($paciente['nomePessoa'], 0, $len))) {
                                ?>
                                    <tr>
                                        <td><?= $paciente['nomePessoa'] ?></td>
                                        <td><?= $paciente['cpfPessoa'] ?></td>
                                        <td><?= $paciente['dataNascPessoa'] ?></td>
                                        <td><a href="paciente.php?idPessoa=<?= $paciente['idPessoa'] ?>"><img src="../img/logo_visualizar.png" width="39.38px" height="39.38px" alt="" srcset=""></a></td>
                                        <td><a href="../controllers/CreateController.php?tabela=processo&idPaciente=<?= $paciente['idPaciente']?>&fk_idUniSaude=<?= $usuario['idUniSaude'] ?>&fk_idFuncionario=<?= $usuario['idFuncionario'] ?>" class="bi bi-check2-circle" style="font-size: 30px; color: var(--third-color);"></a></td>
                                    </tr>
                                <?php
                            };
                        }
                    } else {
                        foreach($pacientes as $paciente) {
                            ?>
                                <tr>
                                    <td><?= $paciente['nomePessoa'] ?></td>
                                    <td><?= $paciente['cpfPessoa'] ?></td>
                                    <td><?= $paciente['dataNascPessoa'] ?></td>
                                    <td><a href="paciente.php?idPessoa=<?= $paciente['idPessoa'] ?>"><img src="../img/logo_visualizar.png" width="39.38px" height="39.38px" alt="" srcset=""></a></td>
                                    <td><a href="../controllers/CreateController.php?tabela=processo&idPaciente=<?= $paciente['idPaciente']?>&fk_idUniSaude=<?= $usuario['idUniSaude'] ?>&fk_idFuncionario=<?= $usuario['idFuncionario'] ?>" class="bi bi-check2-circle" style="font-size: 30px; color: var(--third-color);"></a></td>
                                    
                                </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>

    <?php include '../components/footer.php'; ?>
    <?php include '../components/notificacao.php'; ?>

    <script src="../js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>