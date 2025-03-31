<?php

// Classe de connexion à la base de données

class BddModel {

    // Paramètres de connexion

    private $env;
    private $host = 'localhost:3306';
    private $dbname = 'francois_ecomobil';
    private $username = 'francois_bdd';
    private $password;
    private $conn;

    // Méthode pour la connexion à la base de données

    public function getConnection() {
        $this->env = parse_ini_file(__DIR__ . '/../../../.env');
        $this->password = $this->env['ECOMOBIL_BDD'];
        $this->conn = null;
        try {
            $this->conn = new PDO('mysql:host=' . $this->host . '; dbname=' . $this->dbname . '; charset=utf8', $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $e) {
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
            echo 'password : ' . $this->password;
        }
        return $this->conn;
    }
}