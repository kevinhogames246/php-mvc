<?php

class Exame {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllPessoa() {
        $query = "SELECT * FROM pessoas";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registerExame($nomeExame, $unidadeExame, $arquivoExame, $dataExame,	$fk_idProcedimento) {


        $query = "INSERT INTO exames (nomeExame, unidadeExame, arquivoExame, dataExame, fk_idProcedimento) 
        VALUES (:nomeExame, :unidadeExame, :arquivoExame, :dataExame, :fk_idProcedimento)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nomeExame', $nomeExame, PDO::PARAM_STR);
        $stmt->bindParam(':unidadeExame', $unidadeExame, PDO::PARAM_STR);
        $stmt->bindParam(':arquivoExame', $arquivoExame, PDO::PARAM_STR);
        $stmt->bindParam(':dataExame', $dataExame, PDO::PARAM_STR);
        $stmt->bindParam(':fk_idProcedimento', $fk_idProcedimento, PDO::PARAM_STR);
        return $stmt->execute();
        
    }


    public function updatePessoa($idPessoa, $nomePessoa, $emailPessoa, $senhaPessoa, $tipoPessoa, $docPessoa, $enderecoPessoa, $telPessoa, $dataNascPessoa) {
        $hashedSenha = password_hash($senhaPessoa, PASSWORD_DEFAULT);

        $query = "UPDATE pessoas SET nomePessoa = :nomePessoa, emailPessoa = :emailPessoa, senhaPessoa = :senhaPessoa, tipoPessoa = :tipoPessoa, docPessoa = :docPessoa, enderecoPessoa = :enderecoPessoa, telPessoa = :telPessoa, dataNascPessoa = :dataNascPessoa WHERE idPessoa = :idPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':dataNascPessoa', $dataNascPessoa, PDO::PARAM_STR);
        return $stmt->execute();
        
    }

    public function deletePessoa($emailPessoa) {
        $query = "DELETE FROM pessoas WHERE emailPessoa = :emailPessoa";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':emailPessoa', $emailPessoa, PDO::PARAM_STR);

        return $stmt->execute();
    }
}