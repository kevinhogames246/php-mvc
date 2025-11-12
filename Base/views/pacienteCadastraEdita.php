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
<?php include '../components/head.php'; ?>

<head>
    <!-- <link rel="stylesheet" href="../css/estilo-pacientes.css"> -->
    <link rel="stylesheet" href="../css/estilo-cadastraEdita.css">

</head>

<body>

    <?php include '../components/nav.php'; ?>

    <a href="pacientes.php">
        <div id="seta_voltar">
            <i class="bi bi-chevron-left" style="font-size: 28px"></i>
        </div>
    </a>


    <?php if ($usuario['tipoPessoa'] === 'admin') :
        if (isset($_GET['idPessoa'])) :
            $idPessoa = $_GET['idPessoa'];
            $pessoa = $authController->getPacienteByPessoa($idPessoa);

    ?>
            <h3 id="titulo">Edita Paciente</h3>

            <!-- <form class="forms" action="pacientes.php?action=updatePaciente&idPessoaMudar=<?= $idPessoa ?>" method="POST" enctype="multipart/form-data"> -->
            <form class="forms" action="../controllers/UpdateController.php?tabela=paciente&idUpdate=<?= $idPessoa ?>" method="POST" enctype="multipart/form-data">
                <div style="display: flex;">
                    <div id="foto_paciente">
                        <!-- <img id="foto_pessoa" src="../img/foto_paciente.jpg" alt=""> -->
                        <?php if ($pessoa['arquivoPerfil'] != '') : ?>
                            <img id="foto_pessoa" src="../upload/perfil/<?= $pessoa['arquivoPerfil'] ?>" alt="">
                            <input type="hidden" name="arquivoAntigo" id="nome" placeholder=" " value="<?= $pessoa['arquivoPerfil'] ?>">
                        <?php else : ?>
                            <img id="foto_pessoa" src="../upload/perfil/perfilPadrao.jpg" alt="">
                        <?php endif; ?>
                        <button type="button" class="btn_padrao" id="btn_selecionar" onclick="selecionarArquivo()">Selecionar Foto</button>
                        <input type="file" name="arquivoPerfil" id="selecionar_arquivo" accept="image/*" style="display:none;" onchange="exibirImagemSelecionada()">
                    </div>
                    <div style="margin-right: 40px;">
                        <div class="label-float">
                            <input required type="text" name="nomePessoa" id="nome" placeholder=" " value="<?= $pessoa['nomePessoa'] ?>">
                            <label for="nome">Nome:</label>
                        </div>
                        <div class="label-float">
                            <input required type="text" name="emailPessoa" id="" placeholder=" " value="<?= $pessoa['emailPessoa'] ?>">
                            <label for="">Email:</label>
                        </div>
                        <!-- <div class="label-float">
                            <input type="password" name="senhaPessoa" id="" placeholder=" " value="">
                            <label for="">Senha:</label>
                        </div> -->
                        <div class="label-float">
                            <input type="text" oninput="mascaraCPF(event)" maxlength="15" name="docPessoa" id="cpf" placeholder=" " value="<?= $pessoa['cpfPessoa'] ?>">
                            <label for="cpf">CPF:</label>
                        </div>
                        <div class="label-float">
                            <input required type="date" name="dataNascPessoa" value="<?= $pessoa['dataNascPessoa'] ?>">
                            <label for="dataNasc">Data de Nascimento:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" oninput="mascaraTelefone(event)" maxlength="16" name="telPessoa" id="telefone" placeholder=" " value="<?= $pessoa['telPessoa'] ?>">
                            <label for="telefone">Telefone:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" oninput="mascaraTelefone(event)" maxlength="16" name="telEmergenciaPaciente" id="telEmergenciaPaciente" placeholder=" " value="<?= $pessoa['telEmergenciaPaciente'] ?>">
                            <label for="telEmergenciaPaciente">Telefone de Emergência:</label>
                        </div>
                    </div>
                    <div>
                        <div class="label-float">
                            <input type="text" name="enderecoPessoa" id="endereco" placeholder=" " value="<?= $pessoa['enderecoPessoa'] ?>">
                            <label for="enderecoPessoa">Endereço:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" name="statusPaciente" id="status" maxlength="20" placeholder=" " value="<?= $pessoa['statusPaciente'] ?>">
                            <label for="statusPaciente">Status:</label>
                        </div>
                        <div class="label-float">
                            <textarea rows="5" name="doencaGeneticaPaciente" id="DoencaGen" placeholder=" " value=""><?= $pessoa['doencaGeneticaPaciente'] ?></textarea>
                            <label for="doencaGeneticaPaciente">Doença(s) Genética(s):</label>
                        </div>
                        <div class="label-float">
                            <textarea rows="5" name="alergiaPaciente" id="alergiaPaciente" placeholder=" " value=""><?= $pessoa['alergiaPaciente'] ?></textarea>
                            <label for="alergiaPaciente">Alergia(s):</label>
                        </div>
                    </div>
                </div>
                <button style="margin: 28px" class="btn_padrao">Editar</button>
            </form>

        <?php else : ?>
            <h3 id="titulo">Cadastra Paciente</h3>

            <!-- <form class="forms" action="pacientes.php?action=registerPaciente" method="POST"> -->
            <form class="forms" action="../controllers/CreateController.php?tabela=paciente" method="POST" enctype="multipart/form-data">
                <div id="colunas">
                    <div id="foto_paciente">
                        <img id="foto_pessoa" src="../img/foto_paciente.jpg" alt="">
                        <button type="button" class="btn_padrao" id="btn_selecionar" onclick="selecionarArquivo()">Selecionar Foto</button>
                        <input type="file" name="arquivoPerfil" id="selecionar_arquivo" accept="image/*" style="display:none;" onchange="exibirImagemSelecionada()">
                    </div>
                    <div id="coluna1">
                        <div class="label-float">
                            <input required type="text" name="nomePessoa" id="nome" placeholder=" " value="">
                            <label for="nome">Nome:</label>
                        </div>
                        <div class="label-float">
                            <input required type="text" name="emailPessoa" id="email" placeholder=" " value="">
                            <label for="email">Email:</label>
                        </div>
                        <div class="label-float">
                            <input required type="text" name="senhaPessoa" id="Senha" placeholder=" " value="123456">
                            <label for="senhaPessoa">Senha:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" oninput="mascaraCPF(event)" maxlength="15" name="docPessoa" id="cpf" placeholder=" " value="">
                            <label for="cpf">CPF:</label>
                        </div>
                        <div class="label-float">
                            <input required type="date" name="dataNascPessoa" value=" ">
                            <label for="dataNasc">Data de Nascimento:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" oninput="mascaraTelefone(event)" maxlength="16" name="telPessoa" id="telefone" placeholder=" " value="">
                            <label for="telefone">Telefone:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" oninput="mascaraTelefone(event)" maxlength="16" name="telEmergenciaPaciente" id="telEmergenciaPaciente" placeholder=" " value="">
                            <label for="telEmergenciaPaciente">Telefone de Emergência:</label>
                        </div>
                    </div>
                    <div>
                        <div class="label-float">
                            <input type="text" name="enderecoPessoa" id="endereco" placeholder=" " value="">
                            <label for="enderecoPessoa">Endereço:</label>
                        </div>
                        <div class="label-float">
                            <input type="text" name="statusPaciente" id="status" maxlength="20" placeholder=" " value="">
                            <label for="statusPaciente">Status:</label>
                        </div>
                        <div class="label-float">
                            <textarea rows="5" name="doencaGeneticaPaciente" id="DoencaGen" placeholder=" " value="Nenhuma"></textarea>
                            <label for="doencaGeneticaPaciente">Doença(s) Genética(s):</label>
                        </div>
                        <div class="label-float">
                            <textarea rows="5" name="alergiaPaciente" id="alergiaPaciente" placeholder=" " value="Nenhuma"></textarea>
                            <label for="alergiaPaciente">Alergia(s):</label>
                        </div>
                    </div>
                </div>
                <button style="margin: 28px" class="btn_padrao">Cadastrar</button>
            </form>
        <?php endif; ?>


    <?php elseif ($usuario['tipoPessoa'] === 'user') : header('Location: paciente.php'); ?>

    <?php else : ?>
        <h1 id="titulo">Erro 404</h1>
        <!-- Conteúdo específico para Usuários -->
    <?php endif; ?>

    <?php include '../components/footer.php' ?>

    <script src="../js/javascript.js"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>