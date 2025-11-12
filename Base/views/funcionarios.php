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
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php'; ?>
<body>
    <?php if ($usuario['tipoPessoa'] === 'admin'): ?>

        
        <?php include '../components/nav.php'; ?>

        <h3 id="titulo">Funcionários</h3>
        
        
        <div id="div_pesq_cadastro">       
            <a tabindex="-1" href="funcionarioCadastraEdita.php">
                <button class="btn_padrao">Cadastrar</button>
            </a>

            <!-- 
                Pegar todos os itens de paciente e colocar em um json, filtrar pelo js usando a função, onKeyUp=""
             -->
            <form class="forms" action="">
                <div class="label-float">
                    <input onKeyUp="showHint(this.value)" name="busca" placeholder=" " type="text">
                    <label for="busca">Buscar Paciente</label>
                    <button id="btn_lupa"><i class="bi bi-search" style="font-size: 22px; margin-left: 8px;"></i></button>
                </div>
            </form>
        </div>

        <div id="table-container">
            <table>
                <tbody>    
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Cargo</th>
                        <th>Data Nasc.</th>
                        <th>Visualizar</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>

                    <?php
                        $busca = $_GET["busca"] ?? '';

                        $funcionarios = $authController->getAllFuncionarios();
                        
                        if ($busca !== "") {
                            $busca = strtolower($busca);
                            $len = strlen($busca);
                            foreach($funcionarios as $funcionario) {
                                if (stristr($busca, substr($funcionario['nomePessoa'], 0, $len))) {
                                    ?>
                                        <tr>
                                            <td><?= $funcionario['nomePessoa'] ?></td>
                                            <td><?= $funcionario['cpfPessoa'] ?></td>
                                            <td><?= $funcionario['cargoFuncionario'] ?></td>
                                            <td><?= ($funcionario['dataNascPessoa'] != '') ? date('d/m/Y', strtotime($funcionario['dataNascPessoa'])) : '' ?></td>
                                            
                                            <td><a href="funcionario.php?idPessoa=<?= $funcionario['idPessoa'] ?>"><img src="../img/logo_visualizar.png" width="39.38px" height="39.38px" alt="" srcset=""></a></td>
                                            <td><a href="funcionarioCadastraEdita.php?idPessoa=<?= $funcionario['idPessoa'] ?>"><img src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>
                                            <td><img onclick="mostraCaixa(<?= $funcionario['idPessoa'] ?>, 'funcionario')" src="../img/logo_excluir.png" width="27.5px" height="34px" alt="lixeira" srcset=""></td>
                                        </tr>
                                    <?php
                                };
                            }
                        } else {
                            foreach($funcionarios as $funcionario) {
                                ?>
                                    <tr>
                                        <td><?= $funcionario['nomePessoa'] ?></td>
                                        <td><?= $funcionario['cpfPessoa'] ?></td>
                                        <td><?= $funcionario['cargoFuncionario'] ?></td>
                                        <td><?= ($funcionario['dataNascPessoa'] != '') ? date('d/m/Y', strtotime($funcionario['dataNascPessoa'])) : '' ?></td>

                                        <td><a href="funcionario.php?idPessoa=<?= $funcionario['idPessoa'] ?>"><img src="../img/logo_visualizar.png" width="39.38px" height="39.38px" alt="" srcset=""></a></td>
                                        <td><a href="funcionarioCadastraEdita.php?idPessoa=<?= $funcionario['idPessoa'] ?>"><img src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>
                                        <td><img onclick="mostraCaixa(<?= $funcionario['idPessoa'] ?>, 'funcionario')" src="../img/logo_excluir.png" width="27.5px" height="34px" alt="lixeira" srcset=""></td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>                    

        
    <?php elseif ($usuario['tipoPessoa'] === 'user'): header('Location: paciente.php');?>
        
    <?php else: ?>
        <h1 id="titulo">Erro 404</h1>
        <!-- Conteúdo específico para Usuários -->
    <?php endif; ?>
        <?php include '../components/footer.php'; ?>
    <?php include '../components/notificacao.php'; ?>

            
    <script src="../js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
