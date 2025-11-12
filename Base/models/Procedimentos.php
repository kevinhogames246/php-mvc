<?php

// SELECT * FROM processoproc
// INNER JOIN processos 
// ON processoproc.fk_idProcesso = processos.idProcesso
// INNER JOIN procedimentos
// ON processoproc.fk_idProcedimento = procedimentos.idProcedimento;

class Procedimentos {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllProcedimentos() {
        $query = "SELECT * FROM procedimentos";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getProcedimentoById($idProcedimento) {
        $query = "SELECT * FROM procedimentos pd
        INNER JOIN processos ps ON pd.fk_idProcesso = ps.idProcesso
        INNER JOIN funcionarios fu ON pd.fk_idFuncionario = fu.idFuncionario
        INNER JOIN pessoas pe ON fu.fk_idPessoa = pe.idPessoa
        INNER JOIN cargos ca ON fu.fk_idCargo = ca.idCargo
        WHERE idProcedimento = :idProcedimento";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idProcedimento', $idProcedimento, PDO::PARAM_STR);
        $stmt->execute();
        $procedimento = $stmt->fetch(PDO::FETCH_ASSOC);

        $query = "SELECT * FROM especialidades es
        WHERE idEspecialidade = :idEspecialidade";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idEspecialidade', $procedimento['fk_idEspecialidade'], PDO::PARAM_INT);
        $stmt->execute();
        $especialidade = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($especialidade)){ 
            $procedimento = array_merge($procedimento, $especialidade);
        };

        $query = "SELECT * FROM exames es
        WHERE fk_idProcedimento = :fk_idProcedimento";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fk_idProcedimento', $procedimento['idProcedimento'], PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0){ 
            $exame = $stmt->fetch(PDO::FETCH_ASSOC);
            $procedimento = array_merge($procedimento, $exame); 
        };

        $query = "SELECT * FROM unidadessaude us WHERE idUniSaude = :idUniSaude";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idUniSaude', $procedimento['fk_idUniSaude'], PDO::PARAM_INT);
        $stmt->execute();
        $unidadeSaude = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($unidadeSaude)){ 
            $procedimento = array_merge($procedimento, $unidadeSaude); 
        };

        return $procedimento;
    }

    public function getAllProcedimentosByProcesso($protocoloProcesso) {
        $query = "SELECT * FROM procedimentos pd
        INNER JOIN processos ps ON pd.fk_idProcesso = ps.idProcesso
        INNER JOIN unidadessaude us ON pd.fk_idUniSaude = us.idUniSaude
        WHERE ps.protocoloProcesso = :protocoloProcesso;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':protocoloProcesso', $protocoloProcesso, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registerProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, $obsMedicas, $nomeProcedimento, $descProcedimento, $fk_idProcesso, $fk_idUniSaude, $fk_idFuncionario) {

        $query = "INSERT INTO procedimentos (dataHoraProcedimento, statusHistorico, iconeProcedimento, remedioProcedimento, obsMedicas, nomeProcedimento, descProcedimento, fk_idProcesso, fk_idUniSaude, fk_idFuncionario)
        VALUES (:dataHoraProcedimento, :statusHistorico, :iconeProcedimento, :remedioProcedimento, :obsMedicas, :nomeProcedimento, :descProcedimento, :fk_idProcesso, :fk_idUniSaude, :fk_idFuncionario)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':dataHoraProcedimento', $dataHoraProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':statusHistorico', $statusHistorico, PDO::PARAM_STR);
        $stmt->bindParam(':iconeProcedimento', $iconeProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':remedioProcedimento', $remedioProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':obsMedicas', $obsMedicas, PDO::PARAM_STR);
        $stmt->bindParam(':nomeProcedimento', $nomeProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':descProcedimento', $descProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':fk_idProcesso', $fk_idProcesso, PDO::PARAM_STR);
        $stmt->bindParam(':fk_idUniSaude', $fk_idUniSaude, PDO::PARAM_INT);
        $stmt->bindParam(':fk_idFuncionario', $fk_idFuncionario, PDO::PARAM_STR);
        $procedimento = $stmt->execute();

        return ($procedimento != false) ? $this->db->lastInsertId() : false ;

        
    }

    // Método para atualizar informações do usuário

    // Função não funcional

    public function updateProcedimento($dataHoraProcedimento, $statusHistorico, $iconeProcedimento, $remedioProcedimento, $obsMedicas, $nomeProcedimento, $descProcedimento, $idProcedimento, $fk_idUniSaude, $fk_idFuncionario) {

         $query = "UPDATE procedimentos SET dataHoraProcedimento = :dataHoraProcedimento, statusHistorico = :statusHistorico, iconeProcedimento = :iconeProcedimento, remedioProcedimento = :remedioProcedimento, obsMedicas = :obsMedicas, nomeProcedimento = :nomeProcedimento, descProcedimento = :descProcedimento, fk_idUniSaude = :fk_idUniSaude,  fk_idFuncionario = :fk_idFuncionario
WHERE procedimentos.idProcedimento = :idProcedimento";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':dataHoraProcedimento', $dataHoraProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':statusHistorico', $statusHistorico, PDO::PARAM_STR);
        $stmt->bindParam(':iconeProcedimento', $iconeProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':remedioProcedimento', $remedioProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':obsMedicas', $obsMedicas, PDO::PARAM_STR);
        $stmt->bindParam(':nomeProcedimento', $nomeProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':descProcedimento', $descProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':idProcedimento', $idProcedimento, PDO::PARAM_STR);
        $stmt->bindParam(':fk_idUniSaude', $fk_idUniSaude, PDO::PARAM_INT);
        $stmt->bindParam(':fk_idFuncionario', $fk_idFuncionario, PDO::PARAM_STR);
        $procedimento = $stmt->execute();
        echo '<h3>Model</h3>'; 
        echo '<p><b>nomeProcedimento: </b><i>' . $nomeProcedimento . '</i></p>'; 

        return ($procedimento != false) ? $this->db->lastInsertId() : false ;
     
    }

    // Método para excluir um usuário
    public function deleteProcedimento($idProcedimento) {
        $query = "DELETE FROM procedimentos WHERE idProcedimento = :idProcedimento";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idProcedimento', $idProcedimento, PDO::PARAM_STR);

        return $stmt->execute();
    }
}