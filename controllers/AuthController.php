<?php
require_once dirname(__FILE__) . '/../config/db.php';
require_once dirname(__FILE__) . '/../models/Produtos.php';
require_once dirname(__FILE__) . '/../models/Movimentos.php';
require_once dirname(__FILE__) . '/../models/Enderecos.php';
require_once dirname(__FILE__) . '/../models/Usuarios.php';

class AuthController
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function login($user, $senha)
    {
        $usuariosModel = new Usuarios($this->db);

        if ($usuariosModel->login($user, $senha)) {


            $usuario = $usuariosModel->getUsuarioByUser($user);
            $r = explode(" ", $usuario['nome']);
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $r[0];
            $_SESSION['user'] = $usuario['usuario'];
            $_SESSION['nivel'] = $usuario['nivel'];
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $host = $_SERVER['HTTP_HOST'];  // Captura o domínio (ex: simulador.alles)
            $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');  // Captura o caminho do script, se necessário

            $_SESSION['uri'] = $protocol . $host;

            if ($_SESSION['nivel'] == 100){
                session_destroy();
                return false;
                header('Location: ../');
            } 
            return true;
        } else {
            return false;
        }
    }
    public function getUsuarioById($id)
    {
        $usuariosModel = new Usuarios($this->db);
        return $usuariosModel->getUsuarioById($id);
    }
    public function getUsuarioByUser($user)
    {
        $usuariosModel = new Usuarios($this->db);
        return $usuariosModel->getUsuarioByUser($user);
    }

    public function getUsuariosFilterPage($Params)
    {
        $usuarioModel = new Usuarios($this->db);
        $Param = explode("~", $Params);
    // var_dump($Param);
        $campo = $Param[0];
        $item = $Param[1];
        $page = $Param[2];
        // exit;
        return $usuarioModel->getUsuariosFilterPage($campo, $item, $page);
    }
    public function getMovimentosFilterPage($Params)
    {
        $movimentosModel = new Movimentos($this->db);
        $Param = explode("~", $Params);
    // var_dump($Param);
        $campo = $Param[0];
        $item = $Param[1];
        $page = $Param[2];
        // exit;
        return $movimentosModel->getMovimentosFilterPage($campo, $item, $page);
    }


    public function getAllProdutos()
    {
        $produtosModel = new Produtos($this->db);
        return $produtosModel->getAllProdutos();
    }

    public function getAllProdutosPage($Params)
    {
        $produtosModel = new Produtos($this->db);

        $page = explode("~", $Params)[0];
        // exit;
        return $produtosModel->getAllProdutosPage($page);
    }
    public function getAllProdutosCampos($campos)
    {
        $produtosModel = new Produtos($this->db);
        $campos = explode("~", $campos);
        return $produtosModel->getAllProdutosCampos($campos);
    }
    public function getProdutoByEnderecoCod($codigo)
    {
        $produtosModel = new Produtos($this->db);
        return $produtosModel->getProdutoByEnderecoCod($codigo);
    }
    public function getEnderecosPage($Params)
    {
        $enderecosModel = new Enderecos($this->db);
        $page = explode("~", $Params)[0];
        // exit;
        return $enderecosModel->getEnderecosPage($page);
    }

    public function getEnderecosFilterPage($Params)
    {
        $enderecosModel = new Enderecos($this->db);
        $Param = explode("~", $Params);
    // var_dump($Param);
        $campo = $Param[0];
        $item = $Param[1];
        $page = $Param[2];
        // exit;
        return $enderecosModel->getEnderecosFilterPage($campo, $item, $page);
    }

    //  $Param -> pruduto, endereco
    public function checkProdutoInEndereco($Params)
    {
        $produtosModel = new Produtos($this->db);
        $Params = explode("~", $Params);
        $produtoId = (int) $Params[0];
        $enderecoId = $Params[1];

        return $produtosModel->checkProdutoInEndereco($produtoId, $enderecoId);
    }

    public function registerMovimento($produto, $endereco, $tipo, $peso, $usuario)
    {
        $movimentosModel = new Movimentos($this->db);
        return $movimentosModel->registerMovimento($produto, $endereco, $tipo, $peso, $usuario) ?? false;
    }

    //Criação da função de login


    public function registerUsuario($nome, $usuario, $nivel)
    {
        $usuariosModel = new Usuarios($this->db);
        return $usuariosModel->registerUsuario($nome, $usuario, $nivel);

    }
    public function updateUsuario($nome, $id, $nivel)
    {
        $usuariosModel = new Usuarios($this->db);
        return $usuariosModel->updateUsuario($nome, $id, $nivel);

    }
}


