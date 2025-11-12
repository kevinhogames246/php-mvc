<?php

// SELECT * FROM processoproc
// INNER JOIN processos 
// ON processoproc.fk_idProcesso = processos.idProcesso
// INNER JOIN procedimentos
// ON processoproc.fk_idProcedimento = procedimentos.idProcedimento;

class Movimentos
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllMovimentos($page)
    {
        $query = "SELECT * FROM movimentos
        LIMIT 20 OFFSET :offset;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':offset', (($page * 20) + 20), PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMovimentoById($id)
    {
        $query = "SELECT * FROM movimentos WHERE id = :id;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $toner = $stmt->fetch(PDO::FETCH_ASSOC);

        return $toner;
    }

    public function getMovimentosFilterPage($campo, $item, $page)
    {

        $allowedFields = ['e.codigo', 'p.codigo', 'p.nome', 'u.usuario', 'm.tipo'];
        if (!in_array($campo, $allowedFields)) {
            throw new Exception("Campo não permitido.");
        }

        $page = intval($page);
        $offset = ($page - 1) * 12;

        $query = "SELECT e.codigo as 'eCodigo', p.codigo as 'pCodigo', p.nome, m.peso, m.tipo, u.usuario FROM movimentos m
        INNER JOIN enderecos e ON m.fk_endereco = e.id
        INNER JOIN produtos p ON m.fk_produto = P.id
        INNER JOIN usuarios u ON m.fk_usuario = u.id
        WHERE $campo LIKE :item
        ORDER BY $campo ASC, m.id DESC
        LIMIT 12 OFFSET :offset;";
        // eCodigo ASC,
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':item', $item, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllMovimentosByProduto($produto, $page)
    {
        $query = "SELECT m.id, e.codigo, p.nome, p.peso FROM movimentos m
        INNER JOIN enderecos e ON m.fk_endereco = e.id
        INNER JOIN produtos p ON m.fk_produto = o.id
        WHERE p.id = :id
        LIMIT 20 OFFSET :offset;";
        // $query = "SELECT * FROM processos INNER JOIN pessoas ON pacientes.fk_idPessoa = pessoas.idPessoa;";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $produto, PDO::PARAM_STR);
        $stmt->bindParam(':offset', (($page * 20) + 20), PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registerMovimento($produto, $endereco, $tipo, $peso, $usuario)
    {

        
        try {
            // Iniciar transação
            $this->db->beginTransaction();
            $allowedFields = ['Saida', 'Entrada'];
            if (!in_array($tipo, $allowedFields)) {
                throw new Exception("Tipo não permitido.");
            }
    
            if (0 > $peso) {
                throw new Exception("O Peso não pode ser negativo.");
            }

            // Verificar se o endereço já tem o produto associado
            $query = "SELECT fk_produto, peso, id FROM enderecos WHERE codigo = :endereco";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
            $stmt->execute();
            $enderecoData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($enderecoData['peso'] < $peso && $tipo == 'Saida') {
                throw new Exception("O Peso extrapola o limite.");
            }

            if ($enderecoData['fk_produto'] == $produto || $enderecoData['fk_produto'] == null) {
                if ($tipo == 'Saida') {
                    $peso = (-1) * $peso;
                }

                // Registrar o movimento
                $query = "INSERT INTO movimentos 
                (fk_produto, fk_endereco, tipo, peso, fk_usuario) VALUES 
                (:fk_produto, :fk_endereco, :tipo, :peso, :usuario)";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':fk_produto', $produto, PDO::PARAM_STR);
                $stmt->bindParam(':fk_endereco', $enderecoData['id'], PDO::PARAM_STR);
                $stmt->bindParam(':tipo', $tipo, PDO::PARAM_STR);
                $stmt->bindParam(':peso', $peso, PDO::PARAM_STR);
                $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
                $stmt->execute();

                // Agora ajustar o saldo (peso) do endereço de acordo com o tipo de movimento
                // Primeiro, buscamos o saldo atual de peso no endereço
                $fk_movimento = $this->db->lastInsertId();

                $pesoAtual = $enderecoData['peso'];



                // Se for uma entrada, somar o peso, se for saída, subtrair
                // if ($tipo == 'Entrada') {
                //     $novoPeso = $pesoAtual + $peso;
                // } elseif ($tipo == 'Saida') {
                    //     $novoPeso = $pesoAtual - $peso;
                    // } 
                    

                    // echo var_dump($peso) . "<br>";
                $novoPeso = $pesoAtual + $peso;
                
                // echo var_dump($novoPeso) . "<br>";
                // echo var_dump(0) . "<br>";
                // echo var_dump(0.0) . "<br>";
                // echo var_dump($novoPeso === 0.0) . "<br>";
                if ($novoPeso === 0.0) {
                    $produto = null;
                    $novoPeso = null;
                }

                // echo var_dump($produto) . "<br>";
                // echo var_dump($novoPeso) . "<br>";
                
                // Atualizar o novo peso no endereço
                $query = "UPDATE enderecos SET fk_produto = :fk_produto, peso = :novoPeso, fk_movimento = :fk_movimento WHERE codigo = :endereco";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':fk_produto', $produto, PDO::PARAM_STR);
                $stmt->bindParam(':novoPeso', $novoPeso, PDO::PARAM_STR);
                $stmt->bindParam(':fk_movimento', $fk_movimento, PDO::PARAM_STR);
                $stmt->bindParam(':endereco', $endereco, PDO::PARAM_STR);
                $stmt->execute();



                // Tudo deu certo, confirmar a transação
                $this->db->commit();
                return true; // Sucesso
            } else {
                throw new Exception("O produto não está associado ao endereço informado.");
            }
        } catch (Exception $e) {
            // Se houver algum erro, desfazer tudo (rollback)
            $this->db->rollBack();
            return "Erro ao registrar o movimento: " . $e->getMessage();
        }
    }

}