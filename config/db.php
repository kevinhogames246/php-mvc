<?php
$db_host = 'localhost';
$db_name = 'simulador';
$db_user = 'root';
$db_pass = 'Alles2024*';
// $db_host = 'estocalles.allesalimentos';
// $db_name = 'estocalles';
// $db_user = 'estocalles';
// $db_pass = 'Alles2024*';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    header('Location: views/erro');
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    die();
}
