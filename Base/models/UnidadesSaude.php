<?php

// SELECT * FROM processoproc
// INNER JOIN processos 
// ON processoproc.fk_idProcesso = processos.idProcesso
// INNER JOIN procedimentos
// ON processoproc.fk_idProcedimento = procedimentos.idProcedimento;

class UnidadesSaude {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUnidades() {
        $query = "SELECT * FROM unidadessaude us;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUnidadeByIdPessoa($idPessoa) {
        $query = "SELECT * FROM unidadessaude us
        INNER JOIN pessoas pe ON pe.fk_idUniSaude = us.idUniSaude
        WHERE pe.idPessoa = :idPessoa;";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idPessoa', $idPessoa, PDO::PARAM_STR);
        $stmt->execute();
        // echo "<script>alert('model')</script>";
        
        $uniSaude = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo "<script>alert('"  . $uniSaude['nomeUniSaude'] . "')</script>";
        
        return $uniSaude;
    }
    public function getUnidadeByIdFuncionario($idFuncionario) {
        $query = "SELECT us.idUniSaude FROM pessoas pe
        INNER JOIN unidadessaude us ON pe.fk_idUniSaude = us.idUniSaude
        INNER JOIN funcionarios fu ON fu.fk_idPessoa = pe.idPessoa
        WHERE fu.idFuncionario = :idFuncionario;";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idFuncionario', $idFuncionario, PDO::PARAM_STR);
        $stmt->execute();
        // echo "<script>alert('model')</script>";
        
        $uniSaude = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo "<script>alert('"  . $uniSaude['nomeUniSaude'] . "')</script>";
        
        return $uniSaude;
    }
    
    public function getUnidadeById($idUniSaude) {
        $query = "SELECT * FROM unidadessaude us
        WHERE us.idUniSaude = :idUniSaude;";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idUniSaude', $idUniSaude, PDO::PARAM_STR);
        $stmt->execute();
        // echo "<script>alert('model')</script>";
        
        $uniSaude = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo "<script>alert('"  . $uniSaude['nomeUniSaude'] . "')</script>";
        
        return $uniSaude;
    }
    

    public function registerUniSaude($nomeUniSaude, $enderecoUniSaude, $nomeCidade, $ufEstado) {

        $query = "INSERT INTO unidadessaude (nomeUniSaude, enderecoUniSaude,nomeCidade, ufEstado) 
        VALUES (:nomeUniSaude, :enderecoUniSaude, :nomeCidade, :ufEstado)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomeUniSaude', $nomeUniSaude, PDO::PARAM_STR);
        $stmt->bindParam(':enderecoUniSaude', $enderecoUniSaude, PDO::PARAM_STR);
        $stmt->bindParam(':nomeCidade', $nomeCidade, PDO::PARAM_STR);
        $stmt->bindParam(':ufEstado', $ufEstado, PDO::PARAM_STR);
        return $stmt->execute();
        
    }

    // Método para atualizar informações do usuário

    // Função não funcional
    public function updateUniSaude($nomeUniSaude, $enderecoUniSaude, $nomeCidade, $ufEstado, $idUniSaude) {

        $query = "UPDATE unidadessaude SET nomeUniSaude = :nomeUniSaude, enderecoUniSaude = :enderecoUniSaude, 
        nomeCidade = :nomeCidade, ufEstado = :ufEstado WHERE idUniSaude = :idUniSaude";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomeUniSaude', $nomeUniSaude, PDO::PARAM_STR);
        $stmt->bindParam(':enderecoUniSaude', $enderecoUniSaude, PDO::PARAM_STR);
        $stmt->bindParam(':nomeCidade', $nomeCidade, PDO::PARAM_STR);
        $stmt->bindParam(':ufEstado', $ufEstado, PDO::PARAM_STR);
        $stmt->bindParam(':idUniSaude', $idUniSaude, PDO::PARAM_STR);
        $uniSaude = $stmt->execute();

        return ($uniSaude != false) ? true : false ;
    }

    // Método para excluir um usuário
    public function deleteUniSaude($idUniSaude) {
        $query = "DELETE FROM unidadessaude WHERE idUniSaude = :idUniSaude";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':idUniSaude', $idUniSaude, PDO::PARAM_STR);
        $uniSaude = $stmt->execute();

        return ($uniSaude != false) ? true : false;
    }
}