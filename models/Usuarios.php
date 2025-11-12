<?php
require_once dirname(__FILE__) . '/../controllers/AuthController.php';

class Usuarios {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllUsuarios() {
        $query = "SELECT * FROM usuarios";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getUsuariosFilterPage($campo, $item, $page)
    {

        $allowedFields = ['nome', 'usuario', 'nivel'];
        if (!in_array($campo, $allowedFields)) {
            throw new Exception("Campo não permitido.");
        }

        $page = intval($page);
        $offset = ($page - 1) * 12;

        // Consulta única para endereços com e sem produto
        $query = "SELECT id, nome, usuario as user, nivel
                  FROM usuarios
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

    public function getUsuarioByUser($usuario) {
        $query = "SELECT * FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUsuarioById($id) {
        $query = "SELECT nome, usuario, nivel FROM usuarios pe WHERE pe.id = :id";
        
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Supondo que o ID seja um número inteiro
        $stmt->execute();
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($user, $senha) {

        $query = "SELECT senha FROM usuarios WHERE usuario = :usuario";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario', $user, PDO::PARAM_STR);
        $stmt->execute();
        $hashedSenha = $stmt->fetchColumn();

        if ($hashedSenha == '') {
            return false;
        }elseif (password_verify($senha, $hashedSenha)) {
            return true;
        } else {
            return false;
        }
    }

    public function registerUsuario($nome, $usuario, $nivel) {
        if (strpos($usuario, 'alles.') !== false) {
            $hashedSenha = password_hash(substr($usuario, strpos($usuario, 'alles.') + strlen('alles.')), PASSWORD_DEFAULT);
        } else {
            $hashedSenha = password_hash(1234, PASSWORD_DEFAULT);
        }
        $query = "INSERT INTO usuarios (usuario, nome, nivel, senha) 
                               VALUES (:usuario, :nome, :nivel, :senha)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':usuario', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $hashedSenha, PDO::PARAM_STR);
        $stmt->bindParam(':nivel', $nivel, PDO::PARAM_STR);
        return $stmt->execute();
        
    }

    public function updateUsuario($nome, $id, $nivel) {
        // $hashedSenha = password_hash(1234, PASSWORD_DEFAULT);

        $query = "UPDATE usuarios SET nome = :nome, nivel = :nivel WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':nivel', $nivel, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
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
}