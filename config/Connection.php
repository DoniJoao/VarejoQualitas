<?php

class Connection {
    private $host = 'localhost';
    private $dbname = 'VarejoQualitas';
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // Definir o charset para evitar problemas com acentuação (ç, ã, é)
            $this->conn->exec("set names utf8");
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }

    // Método essencial para o DAO conseguir fazer consultas
    public function getConn() {
        return $this->conn;
    }

    // Método que você já tinha, útil para buscas simples
    public function selectOne($query, $params = []) {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}