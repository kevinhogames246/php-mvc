<?php 

namespace App\Db;

use PDO;
use PDOException;

class Database{
    private static $db_host = '';
    private static $db_name = '';
    private static $db_user = '';
    private static $db_pass = '';

    private $table;

    private $connection;

    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    public static function config($db_host, $db_name, $db_user, $db_pass){
        SELF::$db_host = $db_host;
        SELF::$db_name = $db_name;
        SELF::$db_user = $db_user;
        SELF::$db_pass = $db_pass;
    }

    private function setConnection(){
        try {
            $this->connection = new PDO(
                'mysql:host=' . SELF::$db_host . 
                ';dbname=' . SELF::$db_name . 
                ';charset=utf8',
                SELF::$db_user, 
                SELF::$db_pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            // header('Location: views/erro');
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
            die();
        }
    }

    public function execute($query, $params = []){

        try {
        $statement = $this->connection->prepare($query);
        $statement->execute($params);

        return $statement;
        } catch(PDOException $e) {
            // header('Location: views/erro');
            echo "Erro na conexão com o banco de dados: " . $e->getMessage();
            die();
        }
    }
    public function insert($values){
        
        $fields = array_keys($values);
        $binds  = array_pad([], count($fields), '?');
        $query = 'INSERT INTO ' . $this->table . '('. implode(', ', $fields) .') VALUES (' . implode(', ', $binds) . ')';


        $this->execute($query, array_values($values));

        return $this->connection->lastInsertId(); 
    }

    public function select($where = null, $order = null, $limit = null, $fields = '*'){
        $where = strlen($where) ? 'WHERE ' . $where : '';
        $order = strlen($order) ? 'ORDER BY ' . $order : '';
        $limit = strlen($limit) ? 'LIMIT ' . $limit : '';


        $query = 'SELECT ' . $fields . ' FROM ' . $this->table . ' ' . $where . ' ' . $order . ' ' . $limit;

        return $this->execute($query);
    }

    public function update($where, $values){
        $fields = array_keys($values);

        $query = 'UPDATE ' . $this->table . ' SET ' . implode(' = ?', $fields) .  ' = ? WHERE ' . $where;
        
        $this->execute($query, array_values($values));

        return true;
    }
    public function delete($where){

        $query = 'DELETE FREM ' . $this->table . ' WHERE ' . $where;
        
        $this->execute($query);

        return true;
    }
}