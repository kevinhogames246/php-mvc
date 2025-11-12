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

$tipoPessoa = $authController->getPessoaTipo($_SESSION['emailPessoa']);
$usuario = $authController->getPessoaByEmail($_SESSION['emailPessoa']);

$vaiPra = $_GET['vaiPra'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<?php include '../components/head.php' ?>

<head>
    <link rel="stylesheet" href="../css/estilo-cadastraEdita.css">
</head>

<body>
    <?php if ($usuario['tipoPessoa'] === 'admin') : ?>

        <?php include '../components/nav.php'; ?>

        <a href="pacientes.php">
            <div id="seta_voltar">
                <i class="bi bi-chevron-left" style="font-size: 28px"></i>
            </div>
        </a>

        <?php
        if (isset($_GET['idPessoa'])) :
            $idPessoa = $_GET['idPessoa'];
            $pessoa = $authController->getFuncionarioByPessoa($idPessoa);
        ?>

            <h3 id="titulo">Edita Funcionário</h3>

            <!-- <form class="forms" action="funcionarios.php?action=updateFuncionario&idPessoaMudar=<?= $pessoa['idFuncionario'] ?>" method="POST" enctype="multipart/form-data"> -->
            <form class="forms" action="../controllers/UpdateController.php?tabela=funcionario&idUpdate=<?= $pessoa['idFuncionario'] ?>" method="POST" enctype="multipart/form-data">
                <div id="colunas">

                    <div id="foto_paciente">
                        <?php if ($pessoa['arquivoPerfil'] != '') : ?>
                            <img id="foto_pessoa" src="../upload/perfil/<?= $pessoa['arquivoPerfil'] ?>" alt="">
                        <?php else : ?>
                            <img id="foto_pessoa" src="../upload/perfil/perfilPadrao.jpg" alt="">
                        <?php endif; ?>
                        <button type="button" class="btn_padrao" id="btn_selecionar" onclick="selecionarArquivo()">Selecionar Foto</button>
                        <input type="file" name="arquivoPerfil" id="selecionar_arquivo" accept="image/*" style="display:none;" onchange="exibirImagemSelecionada()">
                    </div>
                    <div id="coluna1">
                        <div class="label-float">
                            <input required type="text" name="nomePessoa" id="nome" placeholder=" " value="<?= $pessoa['nomePessoa'] ?>">
                            <label for="nome">Nome:</label>
                        </div>
                        <div class="label-float">
                            <input required type="text" name="emailPessoa" id="" placeholder=" " value="<?= $pessoa['emailPessoa'] ?>">
                            <label for="">Email:</label>
                        </div>
                        <!-- <div class="label-float"> -->
                        <input type="hidden" name="senhaPessoa" id="" placeholder=" " value="<?= $pessoa['senhaPessoa'] ?>">
                        <!-- <label for="">Senha:</label> -->
                        <!-- </div> -->
                        <div class="label-float">
                            <input type="text" oninput="mascaraCPF(event)" maxlength="15" name="docPessoa" id="cpf" placeholder=" " value="<?= $pessoa['cpfPessoa'] ?>">
                            <label for="cpf">CPF:</label>
                        </div>
                        <select class="select" name="cargoFuncionario" id="">
                            <option value="enfermeira" <?= ($pessoa['cargoFuncionario'] == 'enfermeira') ? 'selected' : '' ?>>enfermeira</option>
                            <option value="medico" <?= ($pessoa['cargoFuncionario'] == 'medico') ? 'selected' : '' ?>>medico</option>
                            <option value="recepcionista" <?= ($pessoa['cargoFuncionario'] == 'recepcionista') ? 'selected' : '' ?>>recepcionista</option>
                            <option value="administrador" <?= ($pessoa['cargoFuncionario'] == 'administrador') ? 'selected' : '' ?>>administrador</option>
                        </select>
                    </div>
                    <div>
                        <div class="label-float">
                            <textarea rows="5" name="especialidadeFuncionario" id="especialidadeFuncionario" placeholder=" " value=""></textarea>
                            <label for="especialidadeFuncionario">Especialidades(s):</label>
                        </div>
                        <div class="label-float">
                            <input required type="date" required name="dataNascPessoa" value="<?= $pessoa['dataNascPessoa'] ?>">
                            <label for="dataNasc">Data de Nascimento:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" oninput="mascaraTelefone(event)" maxlength="16" name="telPessoa" id="telefone" placeholder=" " value="<?= $pessoa['telPessoa'] ?>">
                            <label for="telefone">Telefone:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" name="enderecoPessoa" id="endereco" placeholder=" " value="<?= $pessoa['enderecoPessoa'] ?>">
                            <label for="enderecoPessoa">Endereço:</label>
                        </div>

                    </div>
                </div>
                <!-- Tirar type="button" (somente para teste da notificação) -->
                <button onclick="notificar()" style="margin: 28px" class="btn_padrao">Editar</button>
            </form>
        <?php else : ?>
            <h3 id="titulo">Cadastra Funcionário</h3>
            <!-- <form class="forms" action="funcionarios.php?action=registerFuncionario" method="POST" enctype="multipart/form-data"> -->
            <form class="forms" action="../controllers/CreateController.php?tabela=funcionario" method="POST" enctype="multipart/form-data">
                <div id="colunas">
                    <div id="foto_paciente">
                        <img id="foto_pessoa" src="../upload/perfil/perfilPadrao.jpg" alt="">
                        <button type="button" class="btn_padrao" id="btn_selecionar" onclick="selecionarArquivo()">Selecionar Foto</button>
                        <input type="file" name="arquivoPerfil" id="selecionar_arquivo" accept="image/*" style="display:none;" onchange="exibirImagemSelecionada()">
                    </div>
                    <div id="coluna1">
                        <div class="label-float">
                            <input required type="text" name="nomePessoa" id="nome" placeholder=" " value="">
                            <label for="nome">Nome:</label>
                        </div>
                        <div class="label-float">
                            <input required type="text" name="emailPessoa" id="" placeholder=" " value="">
                            <label for="">Email:</label>
                        </div>
                        <div class="label-float">
                            <input required type="password" name="senhaPessoa" id="" placeholder=" " value="">
                            <label for="">Senha:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" oninput="mascaraCPF(event)" maxlength="15" name="docPessoa" id="cpf" placeholder=" " value="">
                            <label for="cpf">CPF:</label>
                        </div>
                        <select class="select" name="cargoFuncionario" id="">
                            <option value="enfermeira">Enfermeira</option>
                            <option value="medico">Medico</option>
                            <option value="recepcionista" selected>Recepcionista</option>
                            <option value="administrador">Administrador</option>
                        </select>
                    </div>
                    <div>
                        <div class="label-float">
                            <textarea rows="5" name="especialidadeFuncionario" id="especialidadeFuncionario" placeholder=" " value=""></textarea>
                            <label for="especialidadeFuncionario">Especialidades(s):</label>
                        </div>
                        <div class="label-float">
                            <input type="date" required name="dataNascPessoa" value="">
                            <label for="dataNasc">Data de Nascimento:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" oninput="mascaraTelefone(event)" maxlength="16" name="telPessoa" id="telefone" placeholder=" " value="">
                            <label for="telefone">Telefone:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" name="enderecoPessoa" id="endereco" placeholder=" " value="">
                            <label for="enderecoPessoa">Endereço:</label>
                        </div>
                    </div>
                </div>
                <!-- Tirar type="button" (somente para teste da notificação) -->
                <button style="margin: 28px" class="btn_padrao">Cadastrar</button>
            </form>
        <?php endif; ?>


    <?php elseif ($usuario['tipoPessoa'] === 'user') : header('Location: paciente.php'); ?>

    <?php else : ?>
        <h1 id="titulo">Erro 404</h1>
        <!-- Conteúdo específico para Usuários -->
    <?php endif; ?>

    <div class="notificacao">
        <div class="notificacao-content">
            <i class="bi bi-check-lg check" style="font-size: 25px;"></i>
            <div class="mensagem">
                <span class="texto">O Funcionário Foi Cadastrado Com Sucesso!</span>
            </div>
        </div>
        <i class="bi bi-x-lg close"></i>
        <div class="progresso"></div>
    </div>
    <footer>
        <p style="margin: 0;"> Health Track - 2023</p>
        <p style="margin: 0;">TCC - Informatica para internet</p>
        <p style="margin: 0;">Kevin, Mariana e Mateus</p>
    </footer>

    <script>
        function selecionarArquivo() {
            document.getElementById('selecionar_arquivo').click();
        }

        function exibirImagemSelecionada() {
            var input = document.getElementById('selecionar_arquivo');
            var img = document.getElementById('foto_pessoa');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    img.src = e.target.result;
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script src="../js/javascript.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>