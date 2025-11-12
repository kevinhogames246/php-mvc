<?php
require_once dirname(__FILE__) . '/../controllers/AuthController.php';

class Pessoas {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getPessoaOp($idPessoa) {
        $authController = new AuthController($this->db);
        // if($authController->getFuncionarioByPessoa($idPessoa) != FALSE) {
        $query = "SELECT cargoFuncionario FROM funcionarios WHERE fk_idPessoa = :fk_idPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fk_idPessoa', $idPessoa, PDO::PARAM_STR);
        $stmt->execute();
        $cargo = $stmt->fetchColumn();

        switch($cargo) {
            case 'administrador':
                $Op = 'admin';
            break;
            case 'medico':
                $Op = 'medic';
            break;
            case 'enfermeira':
                $Op = 'enfer';
            break;
            case 'recepcionista':
                $Op = 'recep';
            break;
            default:
                $Op = 'user';
                // exit;
        }
        return $Op;
    }

    public function getAllPessoa() {
        $query = "SELECT * FROM pessoas";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPessoaByEmail($emailPessoa) {
        $query = "SELECT * FROM pessoas WHERE emailPessoa = :emailPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getPessoaById($idPessoa) {
        $query = "SELECT * FROM pessoas pe
        INNER JOIN unidadessaude us ON pe.fk_idUniSaude = us.idUniSaude
        WHERE pe.idPessoa = :idPessoa";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_INT); // Supondo que o ID seja um número inteiro
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function getPessoaByPaciente($idPaciente) {
        $query = "SELECT * FROM pacientes pa
        INNER JOIN pessoas pe ON pa.fk_idPessoa = pe.idPessoa
        INNER JOIN unidadessaude us ON pe.fk_idUniSaude = us.idUniSaude
        WHERE pa.idPaciente = :idPaciente";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPaciente', $idPaciente, PDO::PARAM_INT); // Supondo que o ID seja um número inteiro
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function loginPessoa($emailPessoa, $senhaPessoa) {
        $query = "SELECT senhaPessoa FROM pessoas WHERE emailPessoa = :emailPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);
        $stmt->execute();
        $hashedSenha = $stmt->fetchColumn();

        if ($hashedSenha == '') {
            return false;
        }elseif (password_verify($senhaPessoa, $hashedSenha)) {
            return true;
        } else {
            return false;
        }
    }

    public function registerPessoa($nomePessoa, $emailPessoa, $senhaPessoa, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa) {
        $hashedSenha = password_hash($senhaPessoa, PASSWORD_DEFAULT);

        $query = "INSERT INTO pessoas (nomePessoa, emailPessoa, senhaPessoa, tipoPessoa, docPessoa, enderecoPessoa, telPessoa, dataNascPessoa) VALUES (:nomePessoa, :emailPessoa, :senhaPessoa, :tipoPessoa, :docPessoa, :enderecoPessoa, :telPessoa, :dataNascPessoa)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomePessoa', $nomePessoa, PDO::PARAM_STR);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':senhaPessoa', $hashedSenha, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPessoa', $tipoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':docPessoa', $docPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':enderecoPessoa', $enderecoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':telPessoa', $telPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascPessoa', $dataNascPessoa, PDO::PARAM_STR);
        return $stmt->execute();
        
    }

    
    // $query = "UPDATE pessoas SET nomePessoa = :nomePessoa, emailPessoa = :emailPessoa, senhaPessoa = :senhaPessoa, tipoPessoa = :tipoPessoa, docPessoa = :docPessoa, enderecoPessoa = :enderecoPessoa, telPessoa = :telPessoa, dataNascPessoa = :dataNascPessoa WHERE idPessoa = :idPessoa"


    // Método para atualizar informações do usuário

    // Função não funcional


    public function updatePessoa($idPessoa, $nomePessoa, $emailPessoa, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa) {

        $query = "UPDATE pessoas SET nomePessoa = :nomePessoa, emailPessoa = :emailPessoa, tipoPessoa = :tipoPessoa, docPessoa = :docPessoa, enderecoPessoa = :enderecoPessoa, telPessoa = :telPessoa, dataNascPessoa = :dataNascPessoa WHERE idPessoa = :idPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomePessoa', $nomePessoa, PDO::PARAM_STR);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':tipoPessoa', $tipoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':docPessoa', $docPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':enderecoPessoa', $enderecoPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':telPessoa', $telPessoa, PDO::PARAM_STR);
        $stmt->bindParam(':dataNascPessoa', $dataNascPessoa, PDO::PARAM_STR);
        return $stmt->execute();
        
    }

    public function updatePessoaUniSaude($fk_idUniSaude, $idPessoa) {

        $query = "UPDATE pessoas SET fk_idUniSaude = :fk_idUniSaude WHERE idPessoa = :idPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':fk_idUniSaude', $fk_idUniSaude, PDO::PARAM_STR);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_STR);

        return $stmt->execute();
    }
    public function updatePessoaSenha($senhaPessoa, $idPessoa) {
        $hashedSenha = password_hash($senhaPessoa, PASSWORD_DEFAULT);

        $query = "UPDATE pessoas SET senhaPessoa = :senhaPessoa WHERE idPessoa = :idPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':senhaPessoa', $hashedSenha, PDO::PARAM_STR);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_STR);

        return $stmt->execute();
    }

    // Método para excluir um usuário
    public function deletePessoa($emailPessoa) {
        $query = "DELETE FROM pessoas WHERE emailPessoa = :emailPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);

        return $stmt->execute();
    }
    
    public function deletePessoaByDoc($docPessoa) {
        $query = "DELETE FROM pessoas WHERE docPessoa = :docPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':docPessoa', $docPessoa, PDO::PARAM_STR);
    
        return $stmt->execute();
    }
}