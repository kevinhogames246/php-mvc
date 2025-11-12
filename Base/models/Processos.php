<?php

class Processos {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProcessos() { 
        $query = "SELECT * FROM processos 
        INNER JOIN pacientes ON processos.fk_idPaciente = pacientes.idPaciente 
        INNER JOIN pessoas ON pacientes.fk_IdPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProcessosAtivos() {
        $query = "SELECT * FROM processos pc
        INNER JOIN pacientes pa ON pc.fk_idPaciente = pa.idPaciente 
        INNER JOIN pessoas pe ON pa.fk_idPessoa = pe.idPessoa
        WHERE pc.dataFinalProcesso IS NULL;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProcessosByPaciente($idPaciente) {
        $query = "SELECT * FROM processos WHERE fk_idPaciente = :idPaciente";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPaciente', $idPaciente, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProcessosByFuncionario($idFuncionario) {
        $query = "SELECT * FROM procedimentos pd
        INNER JOIN funcionarios f ON pd.fk_idFuncionario = f.idFuncionario
        INNER JOIN processos pr ON pd.fk_idProcesso = pr.idProcesso
        INNER JOIN pacientes pa  ON pr.fk_idPaciente = pa.idPaciente
        INNER JOIN pessoas pe ON pa.fk_idPessoa = pe.idPessoa
        WHERE pd.fk_idFuncionario = :idFuncionario;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON Funcionarios.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idFuncionario', $idFuncionario, PDO::PARAM_STR);
        $stmt->execute();
        $allProcessos = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $unique = [];
        $result = [];

        foreach ($allProcessos as $processo) {
            if (!in_array($processo["protocoloProcesso"], $unique)) {

                $unique[] = $processo["protocoloProcesso"];
                $result[] = $processo;
            }
        }

        return $result;
    }
    

    public function getProcessoById($idProcesso) {
        // $query = "SELECT * FROM processos WHERE idProcesso = :idProcesso";
        $query = "SELECT * FROM processos 
        INNER JOIN pacientes ON processos.fk_idPaciente = pacientes.idPaciente
        INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa 
        WHERE processos.idProcesso = :idProcesso;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idProcesso', $idProcesso, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getProcessoByProtocolo($protocoloProcesso) {
        // $query = "SELECT * FROM processos WHERE protocoloProcesso = :protocoloProcesso";
        $query = "SELECT * FROM processos 
        INNER JOIN pacientes ON processos.fk_idPaciente = pacientes.idPaciente
        INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa 
        WHERE processos.protocoloProcesso = :protocoloProcesso;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':protocoloProcesso', $protocoloProcesso, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function registerProcesso($protocoloProcesso, $fk_idPaciente) {
        $dataInicialProcesso = date('Y-m-d');
        $query = "INSERT INTO processos (protocoloProcesso, dataInicialProcesso, fk_idPaciente) 
        VALUES (:protocoloProcesso, :dataInicialProcesso, :fk_idPaciente)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':protocoloProcesso', $protocoloProcesso, PDO::PARAM_STR);
        $stmt->bindParam(':dataInicialProcesso', $dataInicialProcesso, PDO::PARAM_STR);
        // $stmt->bindParam(':dataFinalProcesso', $dataFinalProcesso, PDO::PARAM_STR);
        $stmt->bindParam(':fk_idPaciente', $fk_idPaciente, PDO::PARAM_INT);
        $processo = $stmt->execute();

        
        return ($processo != false) ? $this->db->lastInsertId() : false ;

    }
    function gerarProtocolo($ufEstado) {
        do {
            $parteAleatoria = sprintf('%02d', mt_rand(1, 99));
            $parteTimestamp = substr(time(), -6);
            $protocolo = 'HT' . $parteAleatoria . $parteTimestamp . $ufEstado;
        } while ($this->protocoloExiste($protocolo));
    
        return $protocolo;
    }
    
    function protocoloExiste($protocolo) {
        $query = "SELECT COUNT(*) FROM processos WHERE protocoloProcesso = :protocolo";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':protocolo', $protocolo);
        $stmt->execute();
        $quantidade = $stmt->fetchColumn();
    
        echo $quantidade;
        // Retorna true se o protocolo existe, false caso contrário
        return ($quantidade > 0);
    }
    

    public function updateProcesso($idProcesso, $protocoloProcesso, $dataInicialProcesso, $dataFinalProcesso, $fk_idPaciente) {

        $query = "UPDATE Processo SET protocoloProcesso = :protocoloProcesso, dataInicialProcesso = :dataInicialProcesso, 
        dataFinalProcesso = :dataFinalProcesso, fk_idPaciente = :fk_idPaciente WHERE processos.idProceso = :idProcesso";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':protocoloProcesso', $protocoloProcesso, PDO::PARAM_STR);
        $stmt->bindParam(':dataInicialProcesso', $dataInicialProcesso, PDO::PARAM_STR);
        $stmt->bindParam(':dataFinalProcesso', $dataFinalProcesso, PDO::PARAM_STR);
        $stmt->bindParam(':fk_idPaciente', $fk_idPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':idProcesso', $idProcesso, PDO::PARAM_STR);
        return $stmt->execute();
        
    }
    
    public function finalizaProcesso($dataFinalProcesso, $idProcesso) {

        $query = "UPDATE processos SET dataFinalProcesso = :dataFinalProcesso WHERE idProcesso = :idProcesso";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':dataFinalProcesso', $dataFinalProcesso, PDO::PARAM_STR);
        $stmt->bindParam(':idProcesso', $idProcesso, PDO::PARAM_STR);
        return $stmt->execute();
        
    }

    public function deleteProcesso($idProcesso) {
        $query = "DELETE FROM processos WHERE idProcesso = :idProcesso";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idProcesso', $idProcesso, PDO::PARAM_STR);

        return $stmt->execute();
    }
}