<?php
$db_host = 'localhost';
$db_name = 'health track';
$db_user = 'root';
$db_pass = '';

try {
    $db = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8", $db_user, $db_pass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    header('Location: views/erro');
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    die();
}
