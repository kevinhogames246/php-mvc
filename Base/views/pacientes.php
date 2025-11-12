<?php
if(!isset($_SESSION['idPessoa'])){
    session_start();
}
require_once '../config/db.php'; 
require_once '../controllers/AuthController.php';


$authController = new AuthController($db);

if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
}

$usuario = $authController->getPessoaById($_SESSION['idPessoa']);

$action = $_GET['action'] ?? '';
$idPessoaMudar = $_GET['idPessoaMudar'] ?? '';
$vaiPra = $_GET['vaiPra'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../components/head.php'; ?>
<body>
    <?php include '../components/nav.php'; ?>

    
    <?php 
        if ($_SESSION['OP'] === 'admin' or $_SESSION['OP'] === 'medic' or $_SESSION['OP'] === 'enfer' or $_SESSION['OP'] === 'recep') : 
    ?>

        <h3 id="titulo">Pacientes</h3>
        
        
        <div id="div_pesq_cadastro">       
            <a tabindex="-1" href="pacienteCadastraEdita">
                <button class="btn_padrao">Cadastrar</button>
            </a>

            <form class="forms" action="">
                <div class="label-float">
                    <input onKeyUp="showHint(this.value)" name="busca" placeholder=" " type="text">
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
                        <th>Editar</th>
                        <?php if ($_SESSION['OP'] != 'recep') : ?>
                            <th>Excluir</th>
                        <?php endif; ?>
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
                                            <td><?= ($paciente['dataNascPessoa'] != '') ? date('d/m/Y', strtotime($paciente['dataNascPessoa'])) : '' ?></td>
                                            <td><a href="paciente.php?idPessoa=<?= $paciente['idPessoa'] ?>"><img alt="Ícone de olho" src="../img/logo_visualizar.png" width="39.38px" height="39.38px" alt="" srcset=""></a></td>
                                            <td><a href="pacienteCadastraEdita.php?idPessoa=<?= $paciente['idPessoa'] ?>"><img alt="Ícone de lápis" src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>
                                            <?php if ($_SESSION['OP'] != 'recep') : ?>
                                                <td><img alt="Ícone de lixeira" onclick="mostraCaixa(<?= $paciente['idPessoa'] ?>, 'paciente')" src="../img/logo_excluir.png" width="27.5px" height="34px" alt="lixeira" srcset=""></td>
                                            <?php endif; ?>
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
                                        <!-- <td><?= date('d/m/Y', strtotime($paciente['dataNascPessoa'])) ?></td> -->
                                        <td><?= ($paciente['dataNascPessoa'] != '') ? date('d/m/Y', strtotime($paciente['dataNascPessoa'])) : '' ?></td>
                                        <td><a href="paciente.php?idPessoa=<?= $paciente['idPessoa'] ?>"><img alt="Ícone de olho" src="../img/logo_visualizar.png" width="39.38px" height="39.38px" alt="" srcset=""></a></td>
                                        <td><a href="pacienteCadastraEdita.php?idPessoa=<?= $paciente['idPessoa'] ?>"><img alt="Ícone de lápis" src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>
                                        <?php if ($_SESSION['OP'] != 'recep') : ?>    
                                            <td><img alt="Ícone de lixeira" onclick="mostraCaixa(<?= $paciente['idPessoa'] ?>, 'paciente')" src="../img/logo_excluir.png" width="27.5px" height="34px" alt="lixeira" srcset=""></td>
                                        <?php endif; ?>
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

        
    <?php elseif ($usuario['tipoPessoa'] === 'user'): header('Location: paciente.php');?>
    <?php else: header('Location: logout');?>
    <?php endif; ?>

    <script src="../js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
