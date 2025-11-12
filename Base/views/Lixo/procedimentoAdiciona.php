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

    $usuario = $authController->getPessoaById($_SESSION['idPessoa']);

?>

<!DOCTYPE html>
<html lang="pt-br">

    <?php include '../components/head.php'; ?>
    <head>
        <link rel="stylesheet" href="../css/estilo-cadastraEdita3.css">
    </head>

    <body>
        <?php include '../components/nav.php'; ?>

        <a href="processoEdita.html">
            <div id="seta_voltar">
                <i class="bi bi-chevron-left" style="font-size: 28px"></i>
            </div>
        </a>

        <h3 id="titulo">Cadastra/Edita Procedimento</h3>

        <form class="forms" action="">
            <div id="colunas">
                <div id="coluna1">
                    <div class="label-float">
                        <input type="text" name="nomeProcedimento" id="E-mail" placeholder=" " value="">
                        <label for="nomeProcedimento">Nome do Procedimento:</label>
                    </div>

                    <div class="label-float">
                        <input type="text" name="descProcedimento" id="E-mail" placeholder=" " value="">
                        <label for="descProcedimento">Descrição do Procedimento:</label>
                    </div>

                    <div class="label-float">
                        <input type="text" name="statusHistorico" id="E-mail" placeholder=" " value="">
                        <label for="statusHistorico">Estado de Saúde do Paciente:</label>
                    </div>

                    <div id="div_icone">
                        <div class="circulo">
                            <i class="bi bi-hospital" style="font-size: 35px; color: white;"></i>
                        </div>
                        <select name="iconeProcedimento" class="select">
                            <option value="0">Selecione um ícone</option>
                            <option value="1">Selecione um ícone</option>
                            <option value="2">teste</option>
                            <option value="3">teste</option>
                            <option value="4">teste</option>
                            <option value="5">teste</option>
                        </select>
                    </div>

                    <div style="margin-top: 15px;">
                        <div class="label-float">
                            <input type="text" name="fk_idFuncionario" id="E-mail" placeholder=" " value=" " readonly>
                            <label for="fk_idFuncionario">Funcionário Responsável:</label>
                            <a href="escolherFuncionario.html"><button type="button" style="margin-left: 10px;"
                                    class="btn_padrao">Selecionar</button></a>
                        </div>

                        <div class="label-float">
                            <input type="text" name="fk_idUniSaude" id="E-mail" placeholder=" " value=" " readonly>
                            <label for="fk_idUniSaude">Unidade de Saúde:</label>
                            <a href="escolherUnidade.html"><button type="button" style="margin-left: 10px"
                                    class="btn_padrao">Selecionar</button></a>
                        </div>
                        <div class="label-float">
                            <input type="text" name="email" id="E-mail" placeholder=" " value=" " readonly>
                            <label for="email">Arquivo do Exame:</label>
                            <button type="button" style="margin-left: 10px" class="btn_padrao">Selecionar</button>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="label-float">
                        <input type="text" name="cpf" id="E-mail" placeholder=" " value="">
                        <label for="cpf">Nome do Exame:</label>
                    </div>
                    <div class="label-float">
                        <input type="text" name="cpf" id="E-mail" placeholder=" " value="">
                        <label for="cpf">Data do Exame:</label>
                    </div>
                    <div class="label-float">
                        <input type="text" name="cpf" id="E-mail" placeholder=" " value="">
                        <label for="cpf">Unidade do Exame:</label>
                    </div>
                    <div class="label-float">
                        <textarea rows="5" name="remedio" id="E-mail" placeholder=" " value=""></textarea>
                        <label for="remedio">Medicamento(s) Prescrito(s):</label>
                    </div>
                    <div class="label-float">
                        <textarea rows="5" name="observacoes" id="E-mail" placeholder=" " value=""></textarea>
                        <label for="observacoes">Observações:</label>
                    </div>
                </div>
            </div>

            <!-- Tirar type="button" (somente para teste da notificação) -->
            <button type="button" onclick="notificar()" style="margin: 45px" class="btn_padrao">Cadastrar</button>
        </form>

        <div class="notificacao">
            <div class="notificacao-content">
                <i class="bi bi-check-lg check" style="font-size: 25px;"></i>
                <div class="mensagem">
                    <span class="texto">O Procedimento foi cadastrado com sucesso!</span>
                </div>
            </div>
            <i class="bi bi-x-lg close"></i>
            <div class="progresso"></div>
        </div>

        <?php include '../components/footer.php'; ?>

        <script src="../js/javascript.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
            crossorigin="anonymous"></script>
    </body>

</html>