<?php

class Cidades {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllCidades() {
        $query = "SELECT * FROM cidades;";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}