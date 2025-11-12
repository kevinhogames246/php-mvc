<html lang="pt-br"></html>
<?php
session_start();
require_once '../config/db.php';
require_once 'AuthController.php';

$authController = new AuthController($db);

if (!isset($_SESSION['emailPessoa'])) {
    header('Location: login.php');
    exit;
}

$usuario = $authController->getPessoaById($_SESSION['idPessoa']);

// echo "<script>alert('" . $usuario['tipoPessoa'] . "')</script>";

if ($usuario['tipoPessoa'] !== 'admin') {
    header('Location: ../index.php');
    exit;
}

if (isset($_GET['tabela'])) {
    $tabela = $_GET['tabela'];
}
if (isset($_GET['idCrear'])) {
    $idCrear = $_GET['idCrear'];
}

switch ($tabela) {
    case "paciente":
        $nomePessoa = $_POST['nomePessoa'];
        $emailPessoa = $_POST['emailPessoa'];
        $senhaPessoa = $_POST['senhaPessoa'];
        $tipoPessoa = "user";
        $docPessoa = $_POST['docPessoa'];
        $enderecoPessoa = $_POST['enderecoPessoa'];
        $telPessoa = $_POST['telPessoa'];
        $dataNascPessoa = $_POST['dataNascPessoa'];
        $statusPaciente = $_POST['statusPaciente'];
        $doencaGeneticaPaciente = $_POST['doencaGeneticaPaciente']; 
        $alergiaPaciente = $_POST['alergiaPaciente']; 
        $telEmergenciaPaciente = $_POST['telEmergenciaPaciente'];
        echo '1.';
        $novoNome = 'perfilPadrao.jpg';
        if(isset($_FILES['arquivoPerfil'])){
            if ($_FILES['arquivoPerfil']['error'] === UPLOAD_ERR_OK) {
                $extensao = strtolower(substr($_FILES['arquivoPerfil']['name'], -4));
                $novoNome = md5(time()) . $extensao;
                $diretorio = "../upload/perfil/";
        
                if (move_uploaded_file($_FILES['arquivoPerfil']['tmp_name'], $diretorio.$novoNome)) {
                    echo 'Arquivo enviado com sucesso!';
                } else {
                    echo 'Falha ao mover o arquivo para o diretório.';
                }
            } else {
                echo 'Erro no envio do arquivo. Código: ' . $_FILES['arquivoPerfil']['error'];
            }
            }

        $paciente = $authController->registerPaciente($nomePessoa, $emailPessoa, $senhaPessoa, $novoNome, $tipoPessoa, $docPessoa, 
        $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiaPaciente, $telEmergenciaPaciente);
        
        // header('Location: pacientes.php');
        if ($paciente != false) {
            // echo "<script>alert('Sucesso')</script>";
            header('Location: return.php?tipo=check' . 
                '&mensagem=paciente cadastrado com sucesso' .
                '&destino=../views/paciente.php?idPessoa=' . $paciente);
        } else {
            // echo "<script>alert('Erro')</script>";
        header('Location: return.php?tipo=x' .
                '&mensagem=Erro ao cadastrar paciente' .
                '&destino=../views/pacientes.php');
        } 

        break;
    case "processo":
        $idPaciente = $_GET['idPaciente'];

        $pessoa = $authController->getPessoaByPaciente($idPaciente);
        $protocoloProcesso = $authController->gerarProtocolo($pessoa['ufEstado']);
        $registroProcesso = $authController->registerProcesso($protocoloProcesso, $idPaciente);

        $fusoHorario = new DateTimeZone('America/Sao_Paulo');
        $dataHoraAtual = new DateTime('now', $fusoHorario);
        $formato = 'Y-m-d H:i:s';
        $dataHoraProcedimento = $dataHoraAtual->format($formato);
        $statusHistorico = 'Não avaliado';
        $iconeProcedimento = 'bi-hospital';
        $remedioProcedimento = '';
        $obsMedicas = '';
        $nomeProcedimento = 'Entrada na unidade';
        $descProcedimento = '';
        $fk_idUniSaude = $_GET['fk_idUniSaude'];
        $fk_idFuncionario = $_GET['fk_idFuncionario'];
        
        echo '' . $registroProcesso;
        
        $condicao = ($registroProcesso != false) 
        ? $authController->registerProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, $obsMedicas, $nomeProcedimento, $descProcedimento, $registroProcesso, $fk_idUniSaude, $fk_idFuncionario)
        : false;
        
        echo '' . $registroProcesso;
        
        if ($condicao != false) {
            // echo "<script>alert('Sucesso')</script>";
            header('Location: return.php?tipo=check' . 
                '&mensagem=processo cadastrado com sucesso' .
                '&destino=../views/processoEdita.php?protocoloProcesso=' . $protocoloProcesso);
        } else {
            // echo "<script>alert('Erro')</script>";
            header('Location: return.php?tipo=x' . 
                '&mensagem=Erro ao cadastrar processo' .
                '&destino=../views/index.php');
        } 
        break;
    case "procedimento":
        // $idPaciente = $_GET['idPaciente'];
        $vemDe = $_POST['vemDe'];
        $fusoHorario = new DateTimeZone('America/Sao_Paulo');
        $dataHoraAtual = new DateTime('now', $fusoHorario);
        $formato = 'Y-m-d H:i:s';
        $dataHoraProcedimento = $dataHoraAtual->format($formato);

        $_SESSION['formProcedimento']['nomeProcedimento'] = $_POST['nomeProcedimento'] ??  $_SESSION['formProcedimento']['nomeProcedimento'];
        $_SESSION['formProcedimento']['descProcedimento'] = $_POST['descProcedimento'] ??  $_SESSION['formProcedimento']['descProcedimento'];
        $_SESSION['formProcedimento']['statusHistorico'] = $_POST['statusHistorico'] ??  $_SESSION['formProcedimento']['statusHistorico'];
        $_SESSION['formProcedimento']['iconeProcedimento'] = $_POST['iconeProcedimento'] ??  $_SESSION['formProcedimento']['iconeProcedimento'];
        $_SESSION['formProcedimento']['fk_idFuncionario'] = $_POST['fk_idFuncionario'] ??  $_SESSION['formProcedimento']['fk_idFuncionario'];
        $_SESSION['formProcedimento']['nomeExame'] = $_POST['nomeExame'] ??  $_SESSION['formProcedimento']['nomeExame'];    
        $_SESSION['formProcedimento']['dataExame'] = $_POST['dataExame'] ??  $_SESSION['formProcedimento']['dataExame'];    
        $_SESSION['formProcedimento']['unidadeExame'] = $_POST['unidadeExame'] ??  $_SESSION['formProcedimento']['unidadeExame'];    
        $_SESSION['formProcedimento']['remedioProcedimento'] = $_POST['remedioProcedimento'] ??  $_SESSION['formProcedimento']['remedioProcedimento'];    
        $_SESSION['formProcedimento']['obsMedicas'] = $_POST['obsMedicas'] ??  $_SESSION['formProcedimento']['obsMedicas']; 
        
        $nomeProcedimento = $_SESSION['formProcedimento']['nomeProcedimento'];
        $descProcedimento = $_SESSION['formProcedimento']['descProcedimento'];
        $statusHistorico = $_SESSION['formProcedimento']['statusHistorico'];
        $iconeProcedimento = $_SESSION['formProcedimento']['iconeProcedimento'];
        $fk_idFuncionario = $_SESSION['formProcedimento']['fk_idFuncionario'];
        $fk_idFuncionario = $_SESSION['formProcedimento']['fk_idFuncionario'];
        echo $fk_idFuncionario;
        if($fk_idFuncionario != ''){
            $fk_idUniSaude = $authController->getUnidadeByIdFuncionario($fk_idFuncionario);
            // $fk_idUniSaude = $authController->getUnidadeByIdFuncionario($fk_idFuncionario);
        };
        $nomeExame = $_SESSION['formProcedimento']['nomeExame'];
        $dataExame = $_SESSION['formProcedimento']['dataExame'];
        $unidadeExame = $_SESSION['formProcedimento']['unidadeExame'];
        $remedioProcedimento = $_SESSION['formProcedimento']['remedioProcedimento'];
        $obsMedicas = $_SESSION['formProcedimento']['obsMedicas'];

        $idProcesso = $_POST['idProcesso'] ?? '';
        $destino = $_POST['destino'] ?? '';

        if($destino == ''){
            if(isset($_FILES['arquivoExame'])){
            if ($_FILES['arquivoExame']['error'] === UPLOAD_ERR_OK) {
                $extensao = strtolower(substr($_FILES['arquivoExame']['name'], -4));
                $novoNome = md5(time()) . $extensao;
                $diretorio = "../upload/exames/";
        
                if (move_uploaded_file($_FILES['arquivoExame']['tmp_name'], $diretorio.$novoNome)) {
                    echo 'Arquivo enviado com sucesso!';
                } else {
                    echo 'Falha ao mover o arquivo para o diretório.';
                }
            } else {
                echo 'Erro no envio do arquivo. Código: ' . $_FILES['arquivoExame']['error'];
            }
            }
            $procedimento = $authController->registerProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, $obsMedicas, $nomeProcedimento, $descProcedimento, $idCrear, $fk_idUniSaude['idUniSaude'], $fk_idFuncionario);
        
            if ($procedimento != '') {

                if (isset($_FILES['arquivoExame'])){
                    $exame = $authController->registerExame($nomeExame, $unidadeExame, $novoNome, $dataExame, $procedimento);
                }
                // echo "<script>alert('Sucesso')</script>";
                // unset($_SESSION['formProcedimento']);
                
                unset($_SESSION['formProcedimento']);
                header('Location: return.php?tipo=check' . 
                    '&mensagem=procedimento cadastrado com sucesso' .
                    '&destino=../views/processoEdita.php?protocoloProcesso=' . $vemDe);
            } else {
                echo "<script>alert('Erro')</script>";
                header('Location: return.php?tipo=x' . 
                    '&mensagem=Erro ao cadastrar procedimento' .
                    '&destino=../views/procedimentoCadastraEdita.php?vemDe=' . $vemDe . '&idProcesso=' . $idCrear);
            }
        }else{
            ?>
            <form id="meuFormulario" action="<?= $destino ?>" method="POST">
                <input type="hidden" name="vemDe" value="<?= $vemDe ?>">
                <input type="hidden" name="idProcesso" value="<?= $idProcesso ?>">
                <!-- <input type="hidden" name="destino" value="<?= $destino ?>"> -->
                <input style="display:none;" type="submit" name="Enviar">
            </form>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var formulario = document.getElementById('meuFormulario');
                    formulario.submit();
                });
            </script>
            <?php
        }
        
         
        break;
    case 'funcionario';
        $nomePessoa = $_POST['nomePessoa'];
        $emailPessoa = $_POST['emailPessoa'];
        $senhaPessoa = $_POST['senhaPessoa'];
        $docPessoa = $_POST['docPessoa'];
        $dataNascPessoa = $_POST['dataNascPessoa'];
        $telPessoa = $_POST['telPessoa'];
        $enderecoPessoa = $_POST['enderecoPessoa'];
        $tipoPessoa = $_POST['tipoPessoa'];
    
            
        
        echo '1.';
        $novoNome = 'perfilPadrao.jpg';
        if(isset($_FILES['arquivoPerfil'])){
            if ($_FILES['arquivoPerfil']['error'] === UPLOAD_ERR_OK) {
                $extensao = strtolower(substr($_FILES['arquivoPerfil']['name'], -4));
                $novoNome = md5(time()) . $extensao;
                $diretorio = "../upload/perfil/";
            
                if (move_uploaded_file($_FILES['arquivoPerfil']['tmp_name'], $diretorio.$novoNome)) {
                    echo 'Arquivo enviado com sucesso!';
                } else {
                    echo 'Falha ao mover o arquivo para o diretório.';
                }
            } else {
                echo 'Erro no envio do arquivo. Código: ' . $_FILES['arquivoPerfil']['error'];
            }
            }

        $funcionario = $authController->registerFuncionario($nomePessoa, $emailPessoa, $senhaPessoa, $novoNome, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa);

        // $paciente = $authController->registerPaciente($nomePessoa, $emailPessoa, $senhaPessoa, $novoNome, $tipoPessoa, $docPessoa, 
        // $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiaPaciente, $telEmergenciaPaciente);
        
        // header('Location: pacientes.php');
        if ($funcionario != false) {
            // echo "<script>alert('Sucesso')</script>";
            header('Location: return.php?tipo=check' . 
                '&mensagem=paciente cadastrado com sucesso' .
                '&destino=../views/funcionario.php?idPessoa=' . $funcionario);
        } else {
            // echo "<script>alert('Erro')</script>";
        header('Location: return.php?tipo=x' .
                '&mensagem=Erro ao cadastrar paciente' .
                '&destino=../views/pacientes.php');
        } 
        break;
    case "pessoas":

        if (isset($_GET['idPessoa'])) {
            $idPessoa = $_GET['idPessoa'];
            if ($authController->deletePaciente($idPessoa)) {
                echo "<script>alert('Usuário excluído com sucesso.')</script>";

                header('Location: ../views/pacientes.php' . '&check=paciente cadastrado');
                exit;
            } else {
                echo "<script>alert('Erro ao excluir o usuário.')</script>";
            }
        } else {
            echo "<script>alert('Usuário não especificado.')</script>";
            exit;
        };
        break;

    default:
        echo "<script>alert('Tabela não existe.')</script>";
        header('Location: return.php?tipo=x' . 
        '&mensagem=tabela não existe' .
        '&destino=../views/index.php');
        exit;
}
