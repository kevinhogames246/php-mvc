<?php

class Funcionarios {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllFuncionarios() {
        // $query = "SELECT * FROM pacientes";
        $query = "SELECT * FROM funcionarios 
        INNER JOIN pessoas ON funcionarios.fk_idPessoa = pessoas.idPessoa 
        ORDER BY `pessoas`.`nomePessoa` ASC;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFuncionarioByPessoa($idPessoa) {
        $query = "SELECT * FROM funcionarios fu
        INNER JOIN pessoas pe ON fu.fk_idPessoa = pe.idPessoa
        INNER JOIN unidadessaude us ON pe.fk_idUniSaude = us.idUniSaude
        WHERE pe.idPessoa = :idPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_INT);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            // Não há funcionário correspondente
            return false;
        }

        if (!$stmt->execute()) {
            // Erro na execução da consulta
            print_r($stmt->errorInfo());
            return false;
        }
        
    }
    


    public function getFuncionarioById($idFuncionario) {
        // $query = "SELECT * FROM pacientes WHERE idFun$idFuncionario = :idFun$idFuncionario";
        $query = "SELECT * FROM funcionarios 
        INNER JOIN pessoas ON funcionarios.fk_idPessoa = pessoas.idPessoa 
        WHERE funcionarios.idFuncionario = :idFuncionario;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idFuncionario', $idFuncionario, PDO::PARAM_INT); // Supondo que o ID seja um número inteiro
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function registerFuncionario($nomePessoa, $emailPessoa, $senhaPessoa, $arquivoPerfil, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa) {
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
            $fk_idEspecialidade = 1;
            $fk_idCargo = 1;

            $query = "INSERT INTO 
            funcionarios (fk_idPessoa, fk_idEspecialidade, fk_idCargo) 
            VALUES (:fk_idPessoa, :fk_idEspecialidade, :fk_idCargo)";
    
            $stmt = $this->db->prepare($query);
    
            $stmt->bindParam(':fk_idPessoa', $fk_idPessoa, PDO::PARAM_INT);
            $stmt->bindParam(':fk_idEspecialidade', $fk_idEspecialidade, PDO::PARAM_INT);
            $stmt->bindParam(':fk_idCargo', $fk_idCargo, PDO::PARAM_INT);
            $funcionario = $stmt->execute();
            
            return $fk_idPessoa;
        } else {
            return false;
        }
    }
    
    // Método para atualizar informações do usuário
    
    // Função não funcional
    public function updateFuncionario($nomePessoa, $emailPessoa, $arquivoPerfil, $cargoFuncionario, $docPessoa, 
    $enderecoPessoa, $telPessoa, $dataNascPessoa, $idFuncionario) {
        $fk_idEspecialidade = 1;
        $fk_idCargo = 1;
        echo '<h3>FuncionariosModel</h3>';
        echo '<p><b>cargo: </b><i>' . $cargoFuncionario . '</i></p>'; 
        echo '<p><b>idFuncionario: </b><i>' . $idFuncionario . '</i></p>'; 

        $query = "UPDATE funcionarios SET fk_idEspecialidade = :fk_idEspecialidade,
         cargoFuncionario = :cargoFuncionario WHERE idFuncionario = :idFuncionario";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fk_idEspecialidade', $fk_idEspecialidade, PDO::PARAM_INT);
        $stmt->bindParam(':cargoFuncionario', $cargoFuncionario, PDO::PARAM_STR);
        $stmt->bindParam(':idFuncionario', $idFuncionario, PDO::PARAM_STR);
        $funcionario = $stmt->execute();
        
        echo '<p><b>Edição do funcionario: </b><i>' . $funcionario . '</i></p>'; 

        $query = "SELECT fk_idPessoa FROM funcionarios WHERE idFuncionario = :idFuncionario";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idFuncionario', $idFuncionario, PDO::PARAM_INT);
        $stmt->execute();
        
        $idPessoa = $stmt->fetchColumn();

        echo '<p><b>idPessoa: </b><i>' . $idPessoa . '</i></p>'; 

        
        $query = "UPDATE pessoas SET nomePessoa = :nomePessoa, emailPessoa = :emailPessoa, arquivoPerfil = :arquivoPerfil, tipoPessoa = :tipoPessoa, cpfPessoa = :cpfPessoa, 
        enderecoPessoa = :enderecoPessoa, telPessoa = :telPessoa, dataNascPessoa = :dataNascPessoa WHERE idPessoa = :idPessoa";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomePessoa', $nomePessoa, PDO::PARAM_STR);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':arquivoPerfil', $arquivoPerfil, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPessoa', $cargoFuncionario, PDO::PARAM_STR);
        $stmt->bindParam(':cpfPessoa', $docPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':enderecoPessoa', $enderecoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':telPessoa', $telPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascPessoa', $dataNascPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_STR);
        $pessoa = $stmt->execute();
        
        
        if ($funcionario and $pessoa){ 
            return $idPessoa;
        }else{
            return false;
        };  
    }

    // Método para excluir um usuário
    public function deleteFuncionario($idPessoa) {
        
        $query = "DELETE FROM funcionarios WHERE fk_idPessoa = :fk_idPessoa";
        
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