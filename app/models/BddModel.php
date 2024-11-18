<?php

// Classe de connexion à la base de données

class BddModel {

    // Paramètres de connexion

    private $host = 'localhost';
    private $dbname = 'ecomobil';
    private $username = 'root';
    private $password = '';
    private $conn;

    // Méthode pour la connexion à la base de données

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbname . '; charset=utf8', $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
        }
        return $this->conn;
    }
}