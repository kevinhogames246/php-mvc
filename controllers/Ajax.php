<?php
session_start();
// require_once '../db.php';
require_once '../controllers/AuthController.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../views/login.php');
    exit;
}

if(isset($_GET['voutar'])){
    header('Location: ' .     $destino = str_replace("~","/", $_GET['voutar']));
}

// Verifica se foi passado o parâmetro 'method' na URL
if (isset($_GET['method']) && isset($_GET['param'])) {
    // Obtém o valor do parâmetro 'method'
    $method = $_GET['method'];
    $param = str_replace("**", "%", $_GET['param']);

    // Verifica se o método solicitado existe na classe Pessoas
    if (method_exists('AuthController', $method)) {
        $AuthController_obj = new AuthController($db);

        // Para fins de depuração, vamos registrar os parâmetros recebidos
        error_log("Método: $method, Param: $param");

        // Chama o método e obtém o resultado
        $result = json_encode($AuthController_obj->$method($param));

        // Registra o resultado para depuração
        error_log("Resultado: $result");

        echo $result;
    } else {
        echo json_encode(array('error' => 'Método inválido'));
    }
} else {
    echo json_encode(array('error' => 'Parâmetro "method" ou "param" não fornecido'));
}
