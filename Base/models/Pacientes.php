<?php
class Pacientes {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPacientes() {
        $query = "SELECT * FROM pacientes
        INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa 
        ORDER BY `pessoas`.`nomePessoa` ASC;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPacienteByPessoa($idPessoa) {
        // $query = "SELECT * FROM pacientes";
        $query = "SELECT * FROM pacientes 
        INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa
        WHERE pessoas.idPessoa = :idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_INT);
        $stmt->execute();
        $paciente = $stmt->fetch(PDO::FETCH_ASSOC);

        $query = "SELECT * FROM unidadessaude us WHERE idUniSaude = :idUniSaude";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idUniSaude', $paciente['fk_idUniSaude'], PDO::PARAM_INT);
        $stmt->execute();
        $unidadeSaude = $stmt->fetch(PDO::FETCH_ASSOC);
        if (isset($unidadeSaude)){ 
            $paciente = array_merge($paciente, $unidadeSaude); 
        };


        return $paciente;
    }

    public function getPacienteById($idPaciente) {
        // $query = "SELECT * FROM pacientes WHERE idPacientes = :idPacientes";
        $query = "SELECT * FROM pacientes 
        INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa 
        WHERE pacientes.idPaciente = :idPaciente;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPaciente', $idPaciente, PDO::PARAM_INT); // Supondo que o ID seja um número inteiro
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function registerPaciente($nomePessoa, $emailPessoa, $senhaPessoa, $arquivoPerfil, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiaPaciente, $telEmergenciaPaciente) {
        $hashedSenha = password_hash($senhaPessoa, PASSWORD_DEFAULT);
        $fk_idUniSaude = 1;

        $query = "INSERT INTO 
        pessoas (nomePessoa, emailPessoa, senhaPessoa, arquivoPerfil, tipoPessoa, cpfPessoa, enderecoPessoa, telPessoa, dataNascPessoa, fk_idUniSaude) 
        VALUES (:nomePessoa, :emailPessoa, :senhaPessoa, :arquivoPerfil, :tipoPessoa, :cpfPessoa, :enderecoPessoa, :telPessoa, :dataNascPessoa, :fk_idUniSaude)";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomePessoa', $nomePessoa, PDO::PARAM_STR);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':senhaPessoa', $hashedSenha, PDO::PARAM_STR);
        $stmt->bindParam(':arquivoPerfil', $arquivoPerfil, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPessoa', $tipoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':cpfPessoa', $docPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':enderecoPessoa', $enderecoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':telPessoa', $telPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascPessoa', $dataNascPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':fk_idUniSaude', $fk_idUniSaude, PDO::PARAM_INT);
        $pessoa = $stmt->execute();
        if (!$pessoa){ 
            return false;
        }
        
        if ($pessoa) {
            $fk_idPessoa = $this->db->lastInsertId();
    
            $query = "INSERT INTO pacientes (statusPaciente, alergiaPaciente, doencaGeneticaPaciente, telEmergenciaPaciente, fk_idPessoa) VALUES (:statusPaciente, :alergiaPaciente, :doencaGeneticaPaciente, :telEmergenciaPaciente, :fk_idPessoa)";
    
            $stmt = $this->db->prepare($query);
    
            $stmt->bindParam(':statusPaciente', $statusPaciente, PDO::PARAM_STR);
            $stmt->bindParam(':alergiaPaciente', $alergiaPaciente, PDO::PARAM_STR);
            $stmt->bindParam(':doencaGeneticaPaciente', $doencaGeneticaPaciente, PDO::PARAM_STR);
            $stmt->bindParam(':telEmergenciaPaciente', $telEmergenciaPaciente, PDO::PARAM_STR);
            $stmt->bindParam(':fk_idPessoa', $fk_idPessoa, PDO::PARAM_INT);
            $paciente = $stmt->execute();
    
            return $fk_idPessoa;
        } else {
            return false;
        }
    }
    
    // Função não funcional
    public function updatePaciente($nomePessoa, $emailPessoa, $arquivoPerfil, $tipoPessoa, $cpfPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiaPaciente, $telEmergenciaPaciente, $fk_idPessoa ) {
        
        echo '<p><b>Data nasc: </b><i>' . $dataNascPessoa . '<i><p>'; 

        $query = "SELECT idPaciente FROM pacientes WHERE fk_idPessoa = :fk_idPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fk_idPessoa', $fk_idPessoa, PDO::PARAM_INT);
        $stmt->execute();
        
        $idPaciente = $stmt->fetchColumn();

        $query = "UPDATE pacientes SET statusPaciente = :statusPaciente, alergiaPaciente = :alergiaPaciente,
        doencaGeneticaPaciente = :doencaGeneticaPaciente, telEmergenciaPaciente = :telEmergenciaPaciente WHERE idPaciente = :idPaciente";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':statusPaciente', $statusPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':alergiaPaciente', $alergiaPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':doencaGeneticaPaciente', $doencaGeneticaPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':telEmergenciaPaciente', $telEmergenciaPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':idPaciente', $idPaciente, PDO::PARAM_STR);
        $paciente = $stmt->execute();

        
        $query = "UPDATE pessoas SET nomePessoa = :nomePessoa, emailPessoa = :emailPessoa, arquivoPerfil = :arquivoPerfil, tipoPessoa = :tipoPessoa, cpfPessoa = :cpfPessoa, 
        enderecoPessoa = :enderecoPessoa, telPessoa = :telPessoa, dataNascPessoa = :dataNascPessoa WHERE idPessoa = :idPessoa";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomePessoa', $nomePessoa, PDO::PARAM_STR);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':arquivoPerfil', $arquivoPerfil, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPessoa', $tipoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':cpfPessoa', $cpfPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':enderecoPessoa', $enderecoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':telPessoa', $telPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascPessoa', $dataNascPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':idPessoa', $fk_idPessoa, PDO::PARAM_INT);
        $pessoa = $stmt->execute();
        
        echo '<p><b>Paciente id: </b><i>' . $idPaciente . '<i><p>'; 
        echo '<p><b>Paciente: </b><i>' . $paciente . '<i><p>'; 
        echo '<p><b>Pessoa: </b><i>' . $pessoa . '<i><p>'; 
        
        if ($paciente and $pessoa){
            return $fk_idPessoa;
        }else{ 
            return false;
        };  
    }

    // Método para excluir um usuário
    public function deletePaciente($idPessoa) {
        
        $query = "DELETE FROM pacientes WHERE fk_idPessoa = :fk_idPessoa";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fk_idPessoa', $idPessoa, PDO::PARAM_STR);
        $paciente = $stmt->execute();
        
        $query = "DELETE FROM pessoas WHERE idPessoa = :idPessoa";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_STR);
        $pessoa = $stmt->execute();

        if ($paciente and $pessoa){ 
            return true;
        }else{ 
            return false;
        }; 
    }
}