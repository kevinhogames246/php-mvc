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

// if ($usuario['tipoPessoa'] !== 'admin') {
//     header('Location: ../index.php');
//     exit;
// }

echo '<h2>UpdateController</h2>';


if (isset($_GET['tabela'])) {
    $tabela = $_GET['tabela'];
    echo '<p><b>tabela -> </b><i>' . $tabela . '</i></p>'; 

}
if (isset($_GET['idUpdate'])) {
    $idUpdate = $_GET['idUpdate'];
    echo '<p><b>idUpdate -> </b><i>' . $idUpdate . '</i></p>'; 

}

switch ($tabela) {
    case "paciente":
        $nomePessoa = $_POST['nomePessoa'];
        $emailPessoa = $_POST['emailPessoa'];
        $tipoPessoa = "user";
        $docPessoa = $_POST['docPessoa'];
        $enderecoPessoa = $_POST['enderecoPessoa'];
        $telPessoa = $_POST['telPessoa'];
        $dataNascPessoa = $_POST['dataNascPessoa'];
        echo '<p><b>Data nasc: </b><i>' . $dataNascPessoa . '<i><p>'; 
        $statusPaciente = $_POST['statusPaciente'];
        $doencaGeneticaPaciente = $_POST['doencaGeneticaPaciente']; 
        $alergiaPaciente = $_POST['alergiaPaciente']; 
        $telEmergenciaPaciente = $_POST['telEmergenciaPaciente'];
        // echo '1.';
        $novoNome = $_POST['arquivoAntigo'] ?? 'perfilPadrao.jpg';
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
                echo '<p><b>Erro no envio do arquivo. Código: </b><i>' . $_FILES['arquivoPerfil']['error'] . '<i><p>'; 
            }
        }

        $paciente = $authController->updatePaciente($nomePessoa, $emailPessoa, $novoNome, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiaPaciente, $telEmergenciaPaciente, $idUpdate);
        echo '<p><b>Paciente: </b><i>' . $paciente . '<i><p>'; 
        
        // header('Location: pacientes.php');
        if ($paciente != false) {
            // echo "<script>alert('Sucesso')</script>";
            header('Location: return.php?tipo=check' . 
                '&mensagem=paciente atualizado com sucesso' .
                '&destino=../views/paciente.php?idPessoa=' . $paciente);
        } else {
            // echo "<script>alert('Erro')</script>";
            header('Location: return.php?tipo=x' .
                '&mensagem=Erro ao atualizar paciente' .
                '&destino=../views/pacientes.php');
        } 

        break;
        
    case "processo":
        $idPaciente = $_GET['idPaciente'];

        $pessoa = $authController->getPessoaByPaciente($idPaciente);
        $protocoloProcesso = $authController->gerarProtocolo($pessoa['ufEstado']);
        $registroProcesso = $authController->registerProcesso($protocoloProcesso, $idPaciente);
        $dataHoraAtual = new DateTime();
        $formato = 'Y-m-d H:i:s';

        $dataHoraProcedimento = $dataHoraAtual->format($formato);
        $statusHistorico = '';
        $iconeProcedimento = 1;
        $remedioProcedimento = 1;
        $obsMedicas = '';
        $nomeProcedimento = 'Entrada na unidade';
        $descProcedimento = '';
        $fk_idUniSaude = $_GET['fk_idUniSaude'];
        $fk_idFuncionario = $_GET['fk_idFuncionario'];
        
        echo '' . $registroProcesso;
        
        $condicao = ($registroProcesso != false) 
        ? $authController->registerProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, $obsMedicas, $nomeProcedimento, $descProcedimento, $registroProcesso, $fk_idUniSaude, $fk_idFuncionario)
        : false;
        
        // echo '' . $registroProcesso;
        
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

        case "processoFinalizar":
            // $idProcesso = $_GET['idProcesso'];
    
         
        $fusoHorario = new DateTimeZone('America/Sao_Paulo');
        $dataHoraAtual = new DateTime('now', $fusoHorario);
        $formato = 'Y-m-d H:i:s';
        $dataHoraProcedimento = $dataHoraAtual->format($formato);
            $statusHistorico = '';
            $iconeProcedimento = 'bi bi-hospital';
            $remedioProcedimento = '';
            $obsMedicas = '';
            $nomeProcedimento = 'Saida da unidade';
            $descProcedimento = '';
            $fk_idFuncionario = $_GET['idFuncionario'];
            $uniSaude = $authController->getUnidadeByIdFuncionario($fk_idFuncionario);
            $fk_idUniSaude = $uniSaude['idUniSaude'];
            // $fk_idUniSaude = $_GET['fk_idUniSaude'];
            echo '<p><b>Funcionario: </b><i>' . $fk_idFuncionario . '<i><p>'; 
            echo '<p><b>Unidade: </b><i>' . $fk_idUniSaude . '<i><p>'; 
            
            $finalizacao = $authController->registerProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, 
            $obsMedicas, $nomeProcedimento, $descProcedimento, $idUpdate, $fk_idUniSaude, $fk_idFuncionario);

            echo '<p><b>Finalização: </b><i>' . $finalizacao . '<i><p>'; 
            
            echo '<p><b>data procedimento final: </b><i>' . $dataHoraProcedimento . '<i><p>'; 
            $formato = 'Y-m-d';
            $dataHoraProcedimento = $dataHoraAtual->format($formato);
            echo '<p><b>data final processo: </b><i>' . $dataHoraProcedimento . '<i><p>'; 
            
            $processo = $authController->getProcessoById($idUpdate);
            $protocoloProcesso = $processo['protocoloProcesso'];
            $condicao = ($finalizacao != false) 
            ? $authController->finalizaProcesso($dataHoraProcedimento, $idUpdate)
            : false;
            
            if ($condicao != false) {
    
                // echo "<script>alert('Sucesso')</script>";
                header('Location: return.php?tipo=check' . 
                    '&mensagem=processo finalizado com sucesso' .
                    '&destino=../views/processoEdita.php?protocoloProcesso=' . $protocoloProcesso);
            } else {
                // echo "<script>alert('Erro')</script>";
                header('Location: return.php?tipo=x' . 
                    '&mensagem=Erro ao finalizar processo' .
                    '&destino=../views/processoEdita.php?protocoloProcesso=' . $protocoloProcesso);
    
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
        $_SESSION['formProcedimento']['dataHoraProcedimento'] = $_POST['dataHoraProcedimento'] ??  $_SESSION['formProcedimento']['dataHoraProcedimento'];
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
        $dataHoraProcedimento = $_SESSION['formProcedimento']['dataHoraProcedimento'];
        $statusHistorico = $_SESSION['formProcedimento']['statusHistorico'];
        $iconeProcedimento = $_SESSION['formProcedimento']['iconeProcedimento'];
        $fk_idFuncionario = $_SESSION['formProcedimento']['fk_idFuncionario'];
        $fk_idUniSaude = $authController->getUnidadeByIdFuncionario($fk_idFuncionario);
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
            $procedimento = $authController->updateProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, 
            $obsMedicas, $nomeProcedimento, $descProcedimento, $idUpdate, $fk_idUniSaude, $fk_idFuncionario);
            echo '<p><b>idProcesso: </b><i>' . $idUpdate . '</i></p>'; 

            if ($procedimento != '') {

                if ($nomeExame != ''){
                    $exame = $authController->registerExame($nomeExame, $unidadeExame, $novoNome, $dataExame, $procedimento);
                }
                // echo "<script>alert('Sucesso')</script>";
                // unset($_SESSION['formProcedimento']);
                echo "<script>alert('Erro')</script>";
                unset($_SESSION['formProcedimento']);
                header('Location: return.php?tipo=check' . 
                    '&mensagem=procedimento cadastrado com sucesso' .
                    '&destino=../views/processoEdita.php?protocoloProcesso=' . $vemDe);
            } else {
                echo "<script>alert('Erro')</script>";
                header('Location: return.php?tipo=x' . 
                    '&mensagem=Erro ao cadastrar procedimento' .
                    '&destino=../views/procedimentoCadastraEdita.php?vemDe=' . $vemDe . '&idProcesso=' . $idUpdate);
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
        $cargoFuncionario = $_POST['cargoFuncionario'];
        
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
                echo '<p><b>Erro no envio do arquivo -> Código: </b><i>' . $_FILES['arquivoPerfil']['error'] . '<i><p>'; 
            }
            }

        $funcionario = $authController->updateFuncionario($nomePessoa, $emailPessoa, $novoNome, $cargoFuncionario, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa, $idUpdate);

        echo '<p><b>cargo: </b><i>' . $cargoFuncionario . '</i></p>'; 
        echo '<p><b>idFuncionario: </b><i>' . $funcionario . '</i></p>'; 

        // header('Location: pacientes.php');
        if ($funcionario != false) {
            echo "<script>alert('Sucesso')</script>";
            header('Location: return.php?tipo=check' . 
                '&mensagem=funcionario atualizado com sucesso' .
                '&destino=../views/funcionario.php?idPessoa=' . $funcionario);
        } else {
            echo "<script>alert('Erro')</script>";
            header('Location: return.php?tipo=x' .
                '&mensagem=Erro ao atualizar funcionario' .
                '&destino=../views/funcionarios.php');
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
    case "unidade":

        $nomeUniSaude = $_POST['nomeUniSaude'];
        $enderecoUniSaude = $_POST['enderecoUniSaude'];
        $nomeCidade = $_POST['nomeCidade'];
        $ufEstado = $_POST['ufEstado'];
        
            if ($authController->updateUniSaude($nomeUniSaude, $enderecoUniSaude, $nomeCidade, $ufEstado, $idUpdate)) {
                echo "<script>alert('Usuário excluído com sucesso.')</script>";
                header('Location: return.php?tipo=check' . 
                '&mensagem=unidade atualizado com sucesso' .
                '&destino=../views/unidades.php');
                exit;
            } else {
                echo "<script>alert('Erro ao excluir o usuário.')</script>";
                header('Location: return.php?tipo=x' . 
                '&mensagem=erro ao atualizar unidade' .
                '&destino=../views/unidades.php');
            }

        break;
    case "pessoaUnidade":

        $idUnidade = $_GET['idUnidade'];
        
            if ($authController->updatePessoaUniSaude($idUnidade, $idUpdate)) {
                echo "<script>alert('Usuário excluído com sucesso.')</script>";
                header('Location: return.php?tipo=check' . '&mensagem=unidade atualizado com sucesso' . '&destino=../views/unidades.php');
                exit;
            } else {
                echo "<script>alert('Erro ao excluir o usuário.')</script>";
                header('Location: return.php?tipo=x' . '&mensagem=erro ao atualizar unidade' . '&destino=../views/unidades.php');
            }

        break;
    case "pessoaSenha":

        $novaSenha_1 = $_POST['novaSenha_1'];
        $novaSenha_2 = $_POST['novaSenha_2'];
        echo $novaSenha_1;
        if($novaSenha_1 === $novaSenha_2) {
            if ($authController->updatePessoaSenha($novaSenha_1, $idUpdate)) {
                echo "<script>alert('Usuário excluído com sucesso.')</script>";
                header('Location: return.php?tipo=check' . '&mensagem=senha atualizada com sucesso' . '&destino=../views/index.php');
            } else {
                echo "<script>alert('Erro ao excluir o usuário.')</script>";
                header('Location: return.php?tipo=x' . '&mensagem=erro ao atualizar a senha' . '&destino=../views/index.php');
            }
        } else {
            header('Location: return.php?tipo=x' . '&mensagem=as senhas não batem' . '&destino=../views/alterarSenha.php?idPessoa=' . $idUpdate);
        }
    
        break;

    default:
        echo "<script>alert('Tabela não existe.')</script>";
        // header('Location: return.php?tipo=x' . 
        // '&mensagem=tabela não existe' .
        // '&destino=../views/index.php');
        exit;
}
