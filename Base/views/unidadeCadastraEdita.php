<?php
    session_start();
    require_once '../config/db.php'; 
    require_once '../controllers/AuthController.php';
    require_once dirname(__FILE__) . '/../models/Pessoas.php';


    $authController = new AuthController($db);

    if (!isset($_SESSION['emailPessoa'])) {
        header('Location: login.php');
        exit;
    }

    $usuario = $authController->getPessoaById($_SESSION['idPessoa']);
            
    $vaiPra = $_GET['vaiPra'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../components/head.php'; ?>
    <body>
        <?php include '../components/nav.php'; ?>


        <a href="unidades.php">
            <div id="seta_voltar">
                <i class="bi bi-chevron-left" style="font-size: 28px"></i>
            </div>
        </a>

    <?php if ($usuario['tipoPessoa'] === 'admin'):
        if (isset($_GET['idUniSaude'])):
            $idUniSaude = $_GET['idUniSaude'];
            $unidade = $authController->getUnidadeById($idUniSaude);
            ?>
            <script>
                const estados = <?= $estados ?>;
            </script>

            <h3 id="titulo">Edita Unidade</h3>

            <form class="forms" action="../controllers/UpdateController.php?tabela=unidade&idUpdate=<?= $idUniSaude ?>" method="POST">

                <div class="label-float">
                    <input type="text" name="nomeUniSaude" id="nomeUniSaude" placeholder=" " value="<?= $unidade['nomeUniSaude']?>">
                    <label for="nome">Nome:</label>
                </div>

                <div class="label-float">
                    <input type="text" name="enderecoUniSaude" id="enderecoUniSaude" placeholder=" " value="<?= $unidade['enderecoUniSaude']?>">
                    <label for="cpf">Endereço:</label>
                </div>

                <input type="hidden" value="<?= $unidade['ufEstado'] ?>" id="EstadoAtual">
                <select id="selectEstado" required name="ufEstado" class="select">
                    <option value="" selected>Estado</option>
                </select>

                <select id="selectCidade" required name="nomeCidade" class="select">
                    <option value="">Cidade</option>
                    <option value="<?= $unidade['nomeCidade'] ?>" selected><?= $unidade['nomeCidade'] ?></option>
                </select>

                <!-- Tirar type="butto;n" (somente para teste da notificação) -->
                <button type="submit" value="updateUniSaude" nome="action" style="margin: 28px" class="btn_padrao">Edita</button>
            </form>

        <?php else: ?>
            <h3 id="titulo">Cadastra Unidade</h3>

            <form class="forms" action="unidades.php?action=registerUniSaude" method="POST">

                <div class="label-float">
                    <input type="text" required name="nomeUniSaude" id="nomeUniSaude" placeholder=" " value="">
                    <label for="nome">Nome:</label>
                </div>

                <div class="label-float">
                    <input type="text" required name="enderecoUniSaude" id="enderecoUniSaude" placeholder=" " value="">
                    <label for="cpf">Endereço:</label>
                </div>

                <input type="hidden" value="" id="EstadoAtual">
                <select id="selectEstado" required name="ufEstado" class="select">
                    <option disabled selected value="">Estado</option>
                </select>

                <select id="selectCidade" required name="nomeCidade" class="select">
                    <option value="">Cidade</option>
                </select>

                <!-- Tirar type="butto;n" (somente para teste da notificação) -->
                <button type="submit" value="updateUniSaude" nome="action" style="margin: 28px" class="btn_padrao">Cadastrar</button>
            </form>
        <?php endif; ?>

        <div class="notificacao">
            <div class="notificacao-content">
                <i class="bi bi-check-lg check" style="font-size: 25px;"></i>
                <div class="mensagem">
                    <span class="texto">A Unidade Foi Cadastrada Com Sucesso!</span>
                </div>
            </div>
            <i class="bi bi-x-lg close"></i>
            <div class="progresso"></div>
        </div>

        <?php include '../components/footer.php'; ?>

        

    <?php elseif ($usuario['tipoPessoa'] === 'user'): header('Location: paciente.php');?>
       
    <?php else: ?>
        <h1 id="titulo">Erro 404</h1>
        <!-- Conteúdo específico para Usuários -->
    <?php endif; ?>

        <script src="../js/javascript.js"></script>
        <script src="../js/cidades.js"></script>
        <script>
            const cidades = <?php echo json_encode($cidades); ?>
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>
</html>