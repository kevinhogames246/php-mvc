<?php

class Pacientes {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPacientes() {
        // $query = "SELECT * FROM pacientes";
        $query = "SELECT * FROM pacientes INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
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
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPacienteById($idPacientes) {
        // $query = "SELECT * FROM pacientes WHERE idPacientes = :idPacientes";
        $query = "SELECT * FROM pacientes 
        INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa 
        WHERE pacientes.idPaciente = :idPaciente;";
        $stmt->bindParam(':idPaciente', $idPaciente, PDO::PARAM_INT); // Supondo que o ID seja um número inteiro
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function registerPaciente($nomePessoa, $emailPessoa, $senhaPessoa, $tipoPessoa, $docPessoa, 
    $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiasPaciente, $telEmergenciaPaciente) {
        $hashedSenha = password_hash($senhaPessoa, PASSWORD_DEFAULT);
        
        
        // "INSERT INTO pessoas (nomePessoa, emailPessoa, senhaPessoa, tipoPessoa, docPessoa, enderecoPessoa, telPessoa, dataNascPessoa) VALUES (:nomePessoa, :emailPessoa, :senhaPessoa, :tipoPessoa, :docPessoa, :enderecoPessoa, :telPessoa, :dataNascPessoa)";
        
        // "SELECT idPessoa FROM pessoas WHERE cpfPaciente = :cpfPaciente; "
        
        $query = "INSERT INTO pessoas (nomePessoa, emailPessoa, senhaPessoa, tipoPessoa, docPessoa, 
        enderecoPessoa, telPessoa, dataNascPessoa) VALUES (:nomePessoa, :emailPessoa, :senhaPessoa, 
        :tipoPessoa, :docPessoa, :enderecoPessoa, :telPessoa, :dataNascPessoa)";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomePessoa', $nomePessoa, PDO::PARAM_STR);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':senhaPessoa', $hashedSenha, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPessoa', $tipoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':docPessoa', $docPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':enderecoPessoa', $enderecoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':telPessoa', $telPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascPessoa', $dataNascPessoa, PDO::PARAM_STR);
        
        $pessoa = $stmt->execute();
        
        $query = "SELECT idPessoa FROM pessoas WHERE docPessoa = :docPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':docPessoa', $docPessoa, PDO::PARAM_STR);
        $stmt->execute();
        
        $fk_idPessoa = $stmt->fetchColumn();
        
        
        $query = "INSERT INTO pacientes (statusPaciente, alergiasPaciente, doencaGeneticaPaciente, 
        telEmergenciaPaciente, fk_idPessoa) VALUES (:statusPaciente, :alergiasPaciente, :doencaGeneticaPaciente, 
        :telEmergenciaPaciente, :fk_idPessoa)";

$stmt = $this->db->prepare($query);

$stmt->bindParam(':statusPaciente', $statusPaciente, PDO::PARAM_STR);
$stmt->bindParam(':alergiasPaciente', $alergiasPaciente, PDO::PARAM_STR);
$stmt->bindParam(':doencaGeneticaPaciente', $doencaGeneticaPaciente, PDO::PARAM_STR);
$stmt->bindParam(':telEmergenciaPaciente', $telEmergenciaPaciente, PDO::PARAM_STR);
$stmt->bindParam(':fk_idPessoa', $fk_idPessoa, PDO::PARAM_INT); // Supondo que o ID seja um número inteiro
$paciente = $stmt->execute();

if ($paciente and $pessoa){ 
            return true;
        }else{ 
            return false;
        };  
    }
    
    // Método para atualizar informações do usuário
    
    // Função não funcional
    public function updatePaciente($nomePessoa, $emailPessoa, $senhaPessoa, $tipoPessoa, $docPessoa, 
    $enderecoPessoa, $telPessoa, $dataNascPessoa, $statusPaciente, $doencaGeneticaPaciente, $alergiasPaciente, $telEmergenciaPaciente, $idPaciente ) {
        
        $query = "UPDATE pacientes SET statusPaciente = :statusPaciente, alergiasPaciente = :alergiasPaciente,
        doencaGeneticaPaciente = :doencaGeneticaPaciente, telEmergenciaPaciente = :telEmergenciaPaciente WHERE idPaciente = :idPaciente";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':statusPaciente', $statusPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':alergiasPaciente', $alergiasPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':doencaGeneticaPaciente', $doencaGeneticaPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':telEmergenciaPaciente', $telEmergenciaPaciente, PDO::PARAM_STR);
        $stmt->bindParam(':idPaciente', $idPaciente, PDO::PARAM_STR);
        $paciente = $stmt->execute();
        
        $query = "SELECT fk_idPessoa FROM pacientes WHERE idPaciente = :idPaciente";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPaciente', $idPaciente, PDO::PARAM_INT);
        $stmt->execute();
        
        $idPessoa = $stmt->fetchColumn();
        
        $query = "UPDATE pessoas SET nomePessoa = :nomePessoa, emailPessoa = :emailPessoa, senhaPessoa = :senhaPessoa, tipoPessoa = :tipoPessoa, docPessoa = :docPessoa, 
        enderecoPessoa = :enderecoPessoa, telPessoa = :telPessoa, dataNascPessoa = :dataNascPessoa WHERE idPessoa = :idPessoa";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomePessoa', $nomePessoa, PDO::PARAM_STR);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':senhaPessoa', $hashedSenha, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPessoa', $tipoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':docPessoa', $docPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':enderecoPessoa', $enderecoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':telPessoa', $telPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascPessoa', $dataNascPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_STR);
        $pessoa = $stmt->execute();
        
        
        if ($paciente and $pessoa){ 
            return true;
        }else{ 
            return false;
        };  
    }

    // Método para excluir um usuário
    public function deletePaciente($emailPessoa) {
        // $query = "DELETE FROM pessoas WHERE idPaciente = :idPaciente";
        // $stmt = $this->db->prepare($query);
        // $stmt->bindParam(':idPaciente', $idPaciente, PDO::PARAM_STR);

        $query = "SELECT idPessoa FROM pessoas WHERE emailPessoa = :emailPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_INT);
        $stmt->execute();

        $idPessoa = $stmt->fetchColumn();
        
        $query = "DELETE FROM pacientes WHERE fk_idPessoa = :idPessoa";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_STR);
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