<?php
    session_start();
    require_once '../config/db.php'; 
    require_once '../controllers/AuthController.php';


    $authController = new AuthController($db);

    if (!isset($_SESSION['emailPessoa'])) {
        header('Location: login.php');
        exit;
    }

    // $idPessoa = $_GET['idPessoa'] ?? '';
    $vemDe = $_REQUEST['vemDe'] ?? '';
    $idProcesso = $_POST['idProcesso'] ?? '';
    $vaiPra = $_GET['vaiPra'] ?? '';
    $tipoPessoa = $authController->getPessoaTipo($_SESSION['emailPessoa']);
    $usuario = $authController->getFuncionarioByPessoa($_SESSION['idPessoa']);
?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../components/head.php'; ?>
<head>
    <link rel="stylesheet" href="../css/estilo-cadastraEdita3.css">
</head>
<body>
    <?php include '../components/nav.php'; ?>

    <a href="procedimentoCadastraEdita.php?vemDe=<?= $vemDe ?>&idProcesso=<?= $idProcesso ?>">
        <div id="seta_voltar">
        <i class="bi bi-chevron-left" style="font-size: 28px"></i>
        </div>
    </a>
    
    <h3 id="titulo">Escolher unidade</h3>

    <div class="div_pesquisa">
        <form class="forms" action="">
            <div class="label-float">
                <input onKeyUp="showHint(this.value)" name="busca" placeholder=" " type="text">
                <label for="busca">Buscar Unidade</label>
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
                    <th>Escolher</th>
                </tr>
                <?php
                    $busca = $_GET["busca"] ?? '';
                    $unidades = $authController->getAllUnidades();

                    if ($busca !== "") {
                        $busca = strtolower($busca);
                        $len = strlen($busca);
                        foreach ($unidades as $unidade) {
                            if (stristr($busca, substr($unidade['nomeUniSaude'], 0, $len))) {
                                ?>
                                <tr>
                                    <td><?= $unidade['nomeUniSaude'] ?></td>
                                    <td><?= $unidade['enderecoUniSaude'] ?></td>
                                    <td><?= $unidade['nomeCidade'] ?></td>
                                    <td><?= $unidade['ufEstado'] ?></td>
                                    <td>
                                        <?php if ($vaiPra === 'unidades') : ?>
                                            <a href="../controllers/updateController.php?tabela=pessoaUnidade&idUpdate=<?= $vemDe ?>&idUnidade=<?= $unidade['idUniSaude'] ?>">
                                                <i class="bi bi-check2-circle" style="font-size: 30px; color: var(--third-color);"></i>
                                            </a>
                                        <?php else : ?>
                                            <a href="procedimentoCadastraEdita.php?vemDe=<?= $vemDe ?>&idProcesso=<?= $idProcesso ?>&idUniSaude=<?= $unidade['idUniSaude'] ?>">
                                                <i class="bi bi-check2-circle" style="font-size: 30px; color: var(--third-color);"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                    } else {
                        foreach ($unidades as $unidade) {
                            ?>
                            <tr>
                                <td><?= $unidade['nomeUniSaude'] ?></td>
                                <td><?= $unidade['enderecoUniSaude'] ?></td>
                                <td><?= $unidade['nomeCidade'] ?></td>
                                <td><?= $unidade['ufEstado'] ?></td>
                                <td>
                                    <?php if ($vaiPra === 'unidades') : ?>
                                        <a href="../controllers/updateController.php?tabela=pessoaUnidade&idUpdate=<?= $vemDe ?>&idUnidade=<?= $unidade['idUniSaude'] ?>">
                                            <i class="bi bi-check2-circle" style="font-size: 30px; color: var(--third-color);"></i>
                                        </a>
                                    <?php else : ?>
                                        <a href="procedimentoCadastraEdita.php?vemDe=<?= $vemDe ?>&idProcesso=<?= $idProcesso ?>&idUniSaude=<?= $unidade['idUniSaude'] ?>">
                                            <i class="bi bi-check2-circle" style="font-size: 30px; color: var(--third-color);"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
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