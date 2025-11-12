<?php

// SELECT * FROM processoproc
// INNER JOIN processos 
// ON processoproc.fk_idProcesso = processos.idProcesso
// INNER JOIN procedimentos
// ON processoproc.fk_idProcedimento = procedimentos.idProcedimento;

class Enderecos
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllEnderecos()
    {
        $query = "SELECT * FROM enderecos";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getEnderecosPage($page)
    {

        $page = intval($page);
        $offset = ($page - 1) * 12;

        // Consulta única para endereços com e sem produto
        $query = "SELECT e.codigo, p.codigo AS codigo_produto, p.nome, e.peso
                  FROM enderecos e
                  LEFT JOIN produtos p ON e.fk_produto = p.id
                  ORDER BY e.codigo
                  LIMIT 12 OFFSET :offset;";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $enderecos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $enderecos;
    }
    public function getEnderecosFilterPage($campo, $item, $page)
    {

        $allowedFields = ['p.codigo', 'e.codigo', 'p.nome'];
        if (!in_array($campo, $allowedFields)) {
            throw new Exception("Campo não permitido.");
        }

        $page = intval($page);
        $offset = ($page - 1) * 12;

        // Consulta única para endereços com e sem produto
        $query = "SELECT e.codigo, p.codigo AS codigo_produto, p.nome, e.peso
                  FROM enderecos e
                  LEFT JOIN produtos p ON e.fk_produto = p.id
                  WHERE $campo LIKE :item
                  ORDER BY $campo
                  LIMIT 12 OFFSET :offset;";

        $stmt = $this->db->prepare($query);
        // $stmt->bindParam(':campo', $campo, PDO::PARAM_STR);
        $stmt->bindParam(':item', $item, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        $enderecos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $enderecos;
    }


    public function getEnderecosPageCampos($campos, $page)
    {
        $offset = ($page - 1) * 12;

        $query = "SELECT " . implode(', ', $campos) . " FROM enderecos
        LIMIT 12 OFFSET :offset;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnderecoById($id)
    {
        $query = "SELECT * FROM enderecos WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $toner = $stmt->fetch(PDO::FETCH_ASSOC);

        return $toner;
    }

    public function getAllEnderecosByProduto($produto)
    {
        $query = "SELECT e.codigo, p.nome, p.peso FROM enderecos e
        INNER JOIN produtos p ON e.fk_produto = p.id
        WHERE p.id = :id;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $produto, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}