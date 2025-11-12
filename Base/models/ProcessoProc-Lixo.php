<?php

// SELECT * FROM processoproc
// INNER JOIN processos 
// ON processoproc.fk_idProcesso = processos.idProcesso
// INNER JOIN procedimentos
// ON processoproc.fk_idProcedimento = procedimentos.idProcedimento;

class ProcessoProc {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProcessosProc() {
        $query = "SELECT * FROM processos";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProcessosProcByProcesso($protocoloProcesso) {
        $query = "SELECT * FROM processosproc pp
        INNER JOIN processos ps ON pp.fk_idProcesso = ps.idProcesso
        INNER JOIN procedimentos pd ON pp.fk_idProcedimento = pd.idProcedimento
        WHERE ps.protocoloProcesso = :protocoloProcesso;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':protocoloProcesso', $protocoloProcesso, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProcessoProcById($idProcessoProc) {
        $query = "SELECT * FROM processosproc pp
        INNER JOIN processos ps ON pp.fk_idProcesso = ps.idProcesso
        INNER JOIN procedimentos pd ON pp.fk_idProcedimento = pd.idProcedimento
        INNER JOIN funcionarios fu ON pp.fk_idFuncionario = fu.idFuncionario
        INNER JOIN pessoas pe ON fu.fk_idPessoa = pe.idPessoa
        INNER JOIN cargos ca ON fu.fk_idCargo = ca.idCargo
        -- INNER JOIN especialidades es ON fu.fk_idEspecialidade = es.idEspecialidade
        WHERE idProcessoProc = :idProcessoProc";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idProcessoProc', $idProcessoProc, PDO::PARAM_INT);
        $stmt->execute();
        $processoProc = $stmt->fetch(PDO::FETCH_ASSOC);

        $query = "SELECT * FROM especialidades es
        WHERE idEspecialidade = :idEspecialidade";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idEspecialidade', $processoProc['fk_idEspecialidade'], PDO::PARAM_INT);
        $stmt->execute();
        $especialidade = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($especialidade)){ 
            $processoProc = array_merge($processoProc, $especialidade);
        };

        $query = "SELECT * FROM Exames es
        WHERE fk_idProcessoProc = :fk_idProcessoProc";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fk_idProcessoProc', $processoProc['idProcessoProc'], PDO::PARAM_INT);
        $stmt->execute();
        $exame = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($exame['idExame'] != 0){ 
            $processoProc = array_merge($processoProc, $exame); 
        };

        $query = "SELECT * FROM unidadessaude us
        INNER JOIN cidades ci ON us.fk_idCidade = ci.idCidade
        INNER JOIN estados es ON ci.fk_idEstado = es.idEstado
        WHERE idUniSaude = :idUniSaude";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idUniSaude', $processoProc['fk_idUniSaude'], PDO::PARAM_INT);
        $stmt->execute();
        $unidadeSaude = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($unidadeSaude)){ 
            $processoProc = array_merge($processoProc, $unidadeSaude); 
        };

        return $processoProc;
    }
}