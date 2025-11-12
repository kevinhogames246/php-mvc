<?php
    session_start();
    require_once '../config/db.php'; 
    require_once '../controllers/authController.php';
    // require_once dirname(__FILE__) . '/../models/Users.php';
    require_once dirname(__FILE__) . '/../models/Pessoas.php';


    // echo '<script>alert("login")</script>';

    $authController = new authController($db);

    $action = $_GET['action'] ?? '';

    // echo '<script>alert("' . "testes" . '");</script>';
    $usuario = $authController->getPessoaById($_SESSION['idPessoa']);

    if (!isset($_SESSION['emailPessoa'])) {
        echo '<script>alert("' . 2 . '");</script>';
        header('Location: login.php');
        exit;
    }

    if ($action === 'registerUniSaude' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $nomeUniSaude = $_POST['nomeUniSaude'];
        $enderecoUniSaude = $_POST['enderecoUniSaude'];
        $nomeCidade = $_POST['nomeCidade'];
        $ufEstado = $_POST['ufEstado'];
        
        $uniSaude = $authController->registerUniSaude($nomeUniSaude, $enderecoUniSaude, $nomeCidade, $ufEstado);

        if ($uniSaude != false) {
            header('Location: unidades.php');
        }else{
            header('Location: unidades.php');
        }
        exit;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../components/head.php'; ?>
    <head>
        <link rel="stylesheet" href="../css/estilo-unidades.css">
    </head>
    <body>

        <?php include '../components/nav.php'; ?>


        <?php if ($usuario['tipoPessoa'] === 'admin'): 
            $estaUnidade = $authController->getUnidadeByIdPessoa($usuario['idPessoa']);

            // echo "<script>alert('" . $estaUnidade['nomeUniSaude'] . "')</script>";

            ?>

            <div id="div_unidade">
                <div>
                    <h3>Esta Unidade de Saúde:</h3>
                    <p><b>Unidade:</b> <?= $estaUnidade['nomeUniSaude'] ?> </p>
                    <p><b>Endereço:</b> <?= $estaUnidade['enderecoUniSaude'] ?> </p>
                    <p><b>Cidade:</b> <?= $estaUnidade['nomeCidade'] ?> </p>
                    <p style="margin: 0;"><b>Estado:</b> <?= $estaUnidade['ufEstado'] ?> </p>
                </div>
                <div>
                    <a href="escolherUnidade.php?vemDe=<?= $usuario['idPessoa'] ?>&vaiPra=unidades"><button class="btn_padrao">Alterar</button></a>
                </div>
            </div>


            <h3 id="titulo">Unidades</h3>

            <div id="div_pesq_cadastro">
                <a href="UnidadeCadastraEdita.php">
                    <button class="btn_padrao">Cadastrar</button>
                </a>

                <form class="forms" action="">
                    <div class="label-float">
                        <input onKeyUp="showHint(this.value)" name="busca" placeholder=" " type="text">
                        <label for="busca">Buscar Unidades</label>
                        <button id="btn_lupa"><i class="bi bi-search" style="font-size: 22px; margin-left: 8px;"></i></button>
                    </div>
                </form>
            </div>

            <div id="table-container">
                <table>
                    <tbody>    
                        <tr>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>Cidade</th>
                            <th>Estado</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>   

                        <?php
                            $busca = $_GET["busca"] ?? '';

                            $unidades = $authController->getAllUnidades();

                            if ($busca !== "") {
                                $busca = strtolower($busca);
                                $len = strlen($busca);
                                foreach($unidades as $unidade) {
                                    if (stristr($busca, substr($unidade['nomeUniSaude'], 0, $len))) {
                                        ?>
                                            <tr>
                                                <td><?= $unidade['nomeUniSaude'] ?></td>
                                                <td><?= $unidade['enderecoUniSaude'] ?></td>
                                                <td><?= $unidade['nomeCidade'] ?></td>
                                                <td><?= $unidade['ufEstado'] ?></td>
                                                <td><a href="unidadeCadastraEdita.php?idUniSaude=<?= $unidade['idUniSaude'] ?>"><img src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>
                                                <td><a href="../controllers/DelController.php?tabela=uniSaude&idExcluir=<?= $unidade['idUniSaude'] ?>" ><img src="../img/logo_excluir.png" width="27.5px" height="34px" alt="lixeira" srcset=""></a></td>
                                            </tr>
                                        <?php
                                    };
                                }
                            } else {
                                foreach($unidades as $unidade) {
                                    ?>
                                        <tr>
                                            <td><?= $unidade['nomeUniSaude'] ?></td>
                                            <td><?= $unidade['enderecoUniSaude'] ?></td>
                                            <td><?= $unidade['nomeCidade'] ?></td>
                                            <td><?= $unidade['ufEstado'] ?></td>
                                            <td><a href="unidadeCadastraEdita.php?idUniSaude=<?= $unidade['idUniSaude'] ?>"><img src="../img/logo_editar.png" width="31px" height="30.25px" alt="" srcset=""></a></td>
                                            <td><a href="../controllers/DelController.php?tabela=uniSaude&idExcluir=<?= $unidade['idUniSaude'] ?>" ><img src="../img/logo_excluir.png" width="27.5px" height="34px" alt="lixeira" srcset=""></a></td>
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
                        
        <?php else: ?>
            <h1 id="titulo">Erro 404</h1>
            <!-- Conteúdo específico para Usuários -->
        <?php endif; ?>

        <script src="../js/javascript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>

