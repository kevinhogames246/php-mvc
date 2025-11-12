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

?>

<!DOCTYPE html>
<html lang="pt-br">
    <?php include '../components/head.php'; ?>
<body>
    
    <?php include '../components/nav.php'; ?>

    <a href="procedimentos.php">
        <div id="seta_voltar">
        <i class="bi bi-chevron-left" style="font-size: 28px"></i>
        </div>
    </a>
    <?php if ($usuario['tipoPessoa'] === 'admin'):
        if (isset($_GET['idProcedimento'])):
            $idProcedimento = $_GET['idProcedimento'];
            $procedimento = $authController->getProcedimentoById($idProcedimento);
            if($procedimento == NULL):
                header('Location: procedimentos.php');
                exit;
            endif;
        ?>
            <h3 id="titulo">Edita Procedimento</h3>

            <form class="forms" action="procedimentos.php?action=registerProcedimento" method="POST">

                <div class="label-float">
                    <input type="text" name="nomeProcedimento" id="nomeProcedimento" placeholder=" " value="<?= $procedimento['nomeProcedimento']?>">
                    <label for="nomeProcedimento">Nome:</label>
                </div>

                <div class="label-float">
                    <textarea rows="5" name="descProcedimento" id="descProcedimento" placeholder=" " value=""><?= $procedimento['descProcedimento']?></textarea>
                    <label for="descProcedimento">Descrição:</label>
                </div>

                <button style="margin: 28px" class="btn_padrao">enviar</button>
            </form>
        
        <?php else: ?>
            <h3 id="titulo">Cadastra Procedimento</h3>

            <form class="forms" action="procedimentos.php?action=registerProcedimento" method="POST">
                    
                <div class="label-float">
                    <input type="text" name="nomeProcedimento" id="E-mail" placeholder=" " value="">
                    <label for="nomeProcedimento">Nome:</label>
                </div>
                    
                <div class="label-float">
                    <textarea rows="5" name="descProcedimento" id="descProcedimento" placeholder=" " value=""></textarea>
                    <label for="descProcedimento">Descrição:</label>
                </div>
                    
                <button style="margin: 28px" class="btn_padrao">Cadastrar</button>
            </form>

        <?php endif; ?>
        

    <?php elseif ($usuario['tipoPessoa'] === 'user'): header('Location: paciente.php');?>
       
    <?php else: ?>
        <h1 id="titulo">Erro 404</h1>
        <!-- Conteúdo específico para Usuários -->
    <?php endif; ?>

    <footer>
        <p style="margin: 0;"> Health Track - 2023</p>
        <p style="margin: 0;">TCC - Informatica para internet</p>
        <p style="margin: 0;">Kevin, Mariana e Mateus</p>
    </footer>    

    <script src="../js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>