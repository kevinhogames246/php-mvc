<?php

// SELECT * FROM processoproc
// INNER JOIN processos 
// ON processoproc.fk_idProcesso = processos.idProcesso
// INNER JOIN procedimentos
// ON processoproc.fk_idProcedimento = procedimentos.idProcedimento;

class Produtos {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    public function getProdutosById($id) {
        $query = "SELECT codigo FROM produtos WHERE id = :id";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllProdutos() {
        $query = "SELECT p.codigo, p.nome, SUM(e.peso) AS peso
FROM produtos p
LEFT JOIN enderecos e ON p.id = e.fk_produto
GROUP BY p.id, p.nome;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllProdutosPage($page)
    {

        $page = intval($page);
        $offset = ($page - 1) * 12;
        
        $query = "SELECT p.codigo, p.nome, SUM(e.peso) AS peso
                  FROM produtos p
                  LEFT JOIN enderecos e ON p.id = e.fk_produto
                  GROUP BY p.id, p.nome
                  ORDER BY peso DESC, p.codigo ASC 
                  LIMIT 12 OFFSET :offset;";
                //   LIMIT 12 OFFSET :offset;";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllProdutosCampos($campos) {
        if (empty($campos)) {
            throw new Exception("Nenhum campo fornecido.");
        }

        $query = "SELECT " . implode(', ', $campos) . " FROM produtos";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getProdutoById($id) {
        $query = "SELECT * FROM produtos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $toner = $stmt->fetch(PDO::FETCH_ASSOC);

        return $toner;
    }

    public function getProdutoByEnderecoCod($codigo) {
        $query = "SELECT p.id, p.codigo, p.nome, e.peso FROM enderecos e
        INNER JOIN produtos p ON e.fk_produto = p.id
        WHERE e.codigo = :codigo;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function checkProdutoInEndereco($produto, $endereco){
        $query = "SELECT fk_produto, peso FROM enderecos WHERE codigo = :codigo;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':codigo', $endereco, PDO::PARAM_STR);
        $stmt->execute();
        $fk_produto = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fk_produto === false) {
            return false;
        } else if ($fk_produto['fk_produto'] == $produto){
            return $fk_produto['peso'];
        } else if ( $fk_produto["fk_produto"] === null){
            return true;
        } else {
            return "Produto: " . $this->getProdutosById($fk_produto['fk_produto'])['codigo'] . " nesse endereco.";
        }
    }
}