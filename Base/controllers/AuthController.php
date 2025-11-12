<?php
require_once dirname(__FILE__) . '/../config/db.php';
require_once dirname(__FILE__) . '/../models/Pessoas.php';
require_once dirname(__FILE__) . '/../models/Pacientes.php';
require_once dirname(__FILE__) . '/../models/Funcionarios.php';
require_once dirname(__FILE__) . '/../models/Procedimentos.php';
require_once dirname(__FILE__) . '/../models/Processos.php';
require_once dirname(__FILE__) . '/../models/UnidadesSaude.php';
require_once dirname(__FILE__) . '/../models/Estados.php';
require_once dirname(__FILE__) . '/../models/Cidades.php';
require_once dirname(__FILE__) . '/../models/Exame.php';

class AuthController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function showRegistrationPage() {
        include 'views/register.php';
    }    
    public function showNavPage() {
        include 'nav.php';
    }
    public function showLoginPage() {
        include 'views/login.php';
    }
    public function showDashboardPage() {
        include 'views/dashboard.php';
    }
    
    //Criação da função de login
    public function loginPessoa($emailPessoa, $senhaPessoa) {
        $pessoasModel = new Pessoas($this->db);
        if ($pessoasModel->loginPessoa($emailPessoa, $senhaPessoa)) {

            $usuario = $pessoasModel->getPessoaByEmail($emailPessoa);
            $r = explode(" ", $usuario['nomePessoa']);
        
            $_SESSION['idPessoa'] = $usuario['idPessoa'];
            $_SESSION['nomePessoa'] = $r[0];
            $_SESSION['emailPessoa'] = $usuario['emailPessoa'];
            $_SESSION['OP'] = $pessoasModel->getPessoaOp($usuario['idPessoa']);        
            // echo $_SESSION['idPessoa'] . ' id controller <br>';
            // echo $_SESSION['tipoPessoa'] . ' tipo controller <br>';
            // echo $pessoasModel->getPessoaTipo($usuario['idPessoa']) . ' chamado <br>';
            return true;
        } else {
            return false;
        }
    }
    //Criação da função de "logout" - Encerramente da Session
    public function logout() {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }

    public function erro() {
        header('Location: ../views/erro.php');
    }
#----> PESSOA

    public function registerPessoa($nomePessoa, $emailPessoa, $senhaPessoa, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa) {
        $pessoasModel = new Pessoas($this->db);
        if ($pessoasModel->registerPessoa($nomePessoa, $emailPessoa, $senhaPessoa, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa)) {
            // Registro bem-sucedido
            header('Location: pacientes.php');
            exit;
        } else {
            // Tratamento de erro de registro
            echo "Erro ao registrar o usuário.";
        }
    }

    
    public function updatePessoaUniSaude($idUniSaude, $idPessoa) {
        $pessoasaModel = new Pessoas($this->db);
        return $pessoasaModel->updatePessoaUniSaude($idUniSaude, $idPessoa);
    }
    
    public function updatePessoaSenha($senhaPessoa, $idPessoa) {
        $pessoasaModel = new Pessoas($this->db);
        return $pessoasaModel->updatePessoaSenha($senhaPessoa, $idPessoa);
    }

    public function getPessoaTipo($emailPessoa) {
        $pessoasModel = new Pessoas($this->db);
        return $pessoasModel->getPessoaOp($emailPessoa);
    }

    public function getPessoaByEmail($emailPessoa) {
        $pessoasModel = new Pessoas($this->db);
        return $pessoasModel->getPessoaByEmail($emailPessoa);
    }
    
    public function getPessoaById($idPessoa) {
        $pessoasModel = new Pessoas($this->db);
        return $pessoasModel->getPessoaById($idPessoa);
    }

    public function getPessoaByPaciente($idPaciente) {
        $pessoasModel = new Pessoas($this->db);
        return $pessoasModel->getPessoaByPaciente($idPaciente);
    }

    public function getAllPessoa() {
        $pessoasModel = new Pessoas($this->db);
        return $pessoasModel->getAllPessoa();
    }

    public function deletePessoa($emailPessoa) {
        $pessoasModel = new Pessoas($this->db);
        if ($pessoasModel->deletePessoa($emailPessoa)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function deletePessoaByDoc($docPessoa) {
        $pessoasModel = new Pessoas($this->db);
        if ($pessoasModel->deletePessoaByDoc($docPessoa)) {
            return true;
        } else {
            return false;
        }
    }

#----> PACIENTE

    public function getAllPacientes() {
        $pacientesModel = new Pacientes($this->db);
        return $pacientesModel->getAllPacientes();
    }

    public function registerPaciente($nomePessoa, $emailPessoa, $senhaPessoa, $arquivoPerfil, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiasPaciente, $telEmergenciaPaciente) {
        $pacientesModel = new Pacientes($this->db);
        $pessoasModel = new Pessoas($this->db);

        return $pacientesModel->registerPaciente($nomePessoa, $emailPessoa, $senhaPessoa, $arquivoPerfil, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiasPaciente, $telEmergenciaPaciente);
    }

    public function updatePaciente($nomePessoa, $emailPessoa, $arquivoPerfil, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiasPaciente, $telEmergenciaPaciente, $idPaciente) {
        $pacientesModel = new Pacientes($this->db);
        return $pacientesModel->updatePaciente($nomePessoa, $emailPessoa, $arquivoPerfil, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, 
        $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiasPaciente, $telEmergenciaPaciente, $idPaciente) ?? false;
    }
    
    public function deletePaciente($idPessoa) {
        $pacientesModel = new Pacientes($this->db);
        if ($pacientesModel->deletePaciente($idPessoa)) {
            return true;
        } else {
            return false;
        }
    }
        
    public function getPacienteById($idPessoa) {
        $pacientesModel = new Pacientes($this->db);
        return $pacientesModel->getPacienteById($idPessoa);
    }
    
    public function getPacienteByPessoa($idPessoa) {
        $pacientesModel = new Pacientes($this->db);
        return $pacientesModel->getPacienteByPessoa($idPessoa);
    }

    
#----> PROCESSO

    public function registerProcesso($protocoloProcesso, $idPaciente) {
        $processosModel = new Processos($this->db);
        return $processosModel->registerProcesso($protocoloProcesso, $idPaciente);
    }
    
    public function finalizaProcesso($dataFinalProcesso, $idProcesso) {
        $processosModel = new Processos($this->db);
        return $processosModel->finalizaProcesso($dataFinalProcesso, $idProcesso);
    }

    public function gerarProtocolo($ufEstado) {
        $processosModel = new Processos($this->db);
        return $processosModel->gerarProtocolo($ufEstado);
    }

    public function getProcessoById($idProcesso) {
        $processosModel = new Processos($this->db);
        return $processosModel->getProcessoById($idProcesso);
    }
    
    public function getProcessoByProtocolo($processoProcesso) {
        $processosModel = new Processos($this->db);
        return $processosModel->getProcessoByProtocolo($processoProcesso);
    }

    public function getAllProcessosByPaciente($idPaciente) {
        $processosModel = new Processos($this->db);
        return $processosModel->getAllProcessosByPaciente($idPaciente);
    }
    
    public function getAllProcessosByFuncionario($idPaciente) {
        $processosModel = new Processos($this->db);
        return $processosModel->getAllProcessosByFuncionario($idPaciente);
    }

    public function getAllProcessosAtivos() {
        $processosModel = new Processos($this->db);
        return $processosModel->getAllProcessosAtivos();
    }
    
    public function getAllProcessos() {
        $processosModel = new Processos($this->db);
        return $processosModel->getAllProcessos();
    }
    
    public function deleteProcesso($idProcesso) {
        $processosModel = new Processos($this->db);
        if ($processosModel->deleteProcesso($idProcesso)) {
            return true;
        } else {
            return false;
        }
    }
    
    
#----> PROCESSOS_PROC

    public function getAllProcessosProcByProcesso($protocoloProcesso) {
        $processoProcModel = new ProcessoProc($this->db);
        return $processoProcModel->getAllProcessosProcByProcesso($protocoloProcesso);
    }
    
    public function getProcessoProcById($idProcessoProc) {
        $processoProcModel = new ProcessoProc($this->db);
        return $processoProcModel->getProcessoProcById($idProcessoProc);
    }
    
#----> PROCEDIMENTO

    public function getAllProcedimentos(){
        $procedimentosModel = new Procedimentos($this->db);
        return $procedimentosModel->getAllProcedimentos();   
    }
    
    public function getProcedimentoById($idProcedimento){
        $procedimentosModel = new Procedimentos($this->db);
        return $procedimentosModel->getProcedimentoById($idProcedimento);   
    }
    
    public function getAllProcedimentosByProcesso($protocoloProcesso) {
        $procedimentosModel = new Procedimentos($this->db);
        return $procedimentosModel->getAllProcedimentosByProcesso($protocoloProcesso);
    }
    
    

    public function registerProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, $obsMedicas, $nomeProcedimento, $descProcedimento, $fk_idProcesso, $fk_idUniSaude, $fk_idFuncionario) {
        $procedimentosModel = new Procedimentos($this->db);
        $idProcedimento = $procedimentosModel->registerProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, $obsMedicas, $nomeProcedimento, $descProcedimento, $fk_idProcesso, $fk_idUniSaude, $fk_idFuncionario);
        
        return ($idProcedimento != false) ? $idProcedimento : false ;

    }

    public function updateProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, $obsMedicas, $nomeProcedimento, $descProcedimento, $idProcedimento, $fk_idUniSaude, $fk_idFuncionario) {
        $procedimentosModel = new Procedimentos($this->db);
        return $procedimentosModel->updateProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, $obsMedicas, $nomeProcedimento, $descProcedimento, $idProcedimento, $fk_idUniSaude, $fk_idFuncionario);

    }

    public function deleteProcedimento($idProcedimento) {
        $procedimentosModel = new Procedimentos($this->db);
        if ($procedimentosModel->deleteProcedimento($idProcedimento)) {
            return true;
        } else {
            return false;
        }
    }

#----> FUNCIONARIO

    public function getAllFuncionarios() {
        $funcionariosModel = new Funcionarios($this->db);
        return $funcionariosModel->getAllFuncionarios();
    }

    public function registerFuncionario($nomePessoa, $emailPessoa, $senhaPessoa, $arquivoPerfil, $tipoPessoa, $docPessoa, 
        $enderecoPessoa, $telPessoa, $dataNascPessoa) {
        $funcionariosModel = new Funcionarios($this->db);
        
        return $funcionariosModel->registerFuncionario($nomePessoa, $emailPessoa, $senhaPessoa, $arquivoPerfil, $tipoPessoa, $docPessoa, 
        $enderecoPessoa, $telPessoa, $dataNascPessoa) ?? false;

        
            // Tratamento de erro de registro
            // $funcionariosModel->deletePacienteByPessoaDoc($docPessoa);
            // $pessoasModel = new Pessoas($this->db);
            // $pessoasModel->deletePessoaByDoc($docPessoa);

            // echo "Erro ao registrar o usuário.";
        
    }

    public function updateFuncionario($nomePessoa, $emailPessoa, $arquivoPerfil, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa, $idFuncionario) {
        $funcionariosModel = new Funcionarios($this->db);
        return $funcionariosModel->updateFuncionario($nomePessoa, $emailPessoa, $arquivoPerfil, 
        $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa, $idFuncionario);
    }
    
    public function deleteFuncionario($idPessoa) {
        $funcionariosModel = new Funcionarios($this->db);
        if ($funcionariosModel->deleteFuncionario($idPessoa)) {
            return true;
        } else {
            return false;
        }
    }
        
    public function getFuncionarioById($idFuncionario) {
        $funcionariosModel = new Funcionarios($this->db);
        return $funcionariosModel->getFuncionarioById($idFuncionario);
    }
    
    public function getFuncionarioByPessoa($idPessoa) {
        $funcionariosModel = new Funcionarios($this->db);
        return $funcionariosModel->getFuncionarioByPessoa($idPessoa);
    }

#----> UNIDADESSAUDE

    public function getAllUnidades() {
        $unidadesSaudeModel = new UnidadesSaude($this->db);
        return $unidadesSaudeModel->getAllUnidades();
    }

    public function getUnidadeByIdPessoa($idPessoa) {
        $unidadesSaudeModel = new UnidadesSaude($this->db);
        return $unidadesSaudeModel->getUnidadeByIdPessoa($idPessoa);
    }
    
    public function getUnidadeByIdFuncionario($idFuncionario) {
        $unidadesSaudeModel = new UnidadesSaude($this->db);
        return $unidadesSaudeModel->getUnidadeByIdFuncionario($idFuncionario);
    }
    public function getUnidadeById($idUniSaude) {
        $unidadesSaudeModel = new UnidadesSaude($this->db);
        return $unidadesSaudeModel->getUnidadeById($idUniSaude);
    }

    public function registerUniSaude($nomeUniSaude, $enderecoUniSaude, $nomeCidade, $ufEstado) {
        $unidadesSaudeModel = new UnidadesSaude($this->db);
        return $unidadesSaudeModel->registerUniSaude($nomeUniSaude, $enderecoUniSaude, $nomeCidade, $ufEstado);
    }

    public function updateUniSaude($nomeUniSaude, $enderecoUniSaude, $nomeCidade, $ufEstado, $idUniSaude) {
        $unidadesSaudeModel = new UnidadesSaude($this->db);
        return $unidadesSaudeModel->updateUniSaude($nomeUniSaude, $enderecoUniSaude, $nomeCidade, $ufEstado, $idUniSaude); 
    }
    public function deleteUniSaude($idUniSaude) {
        $unidadesSaudeModel = new UnidadesSaude($this->db);
        return $unidadesSaudeModel->deleteUniSaude($idUniSaude); 
    }

#----> Estados
    
    public function getAllEstados() {
        $estadosModel = new Estados($this->db);
        return $estadosModel->getAllEstados();
    }

#----> Cidades
    public function getAllCidades() {
        $cidadesModel = new Cidades($this->db);
        return $cidadesModel->getAllCidades();
    }

#----> EXAME

    public function registerExame($nomeExame, $unidadeExame, $arquivoExame, $dataExame,	$fk_idProcedimento) {
        $exameModel = new Exame($this->db);
        return $exameModel->registerExame($nomeExame, $unidadeExame, $arquivoExame, $dataExame,	$fk_idProcedimento);
    }
}


