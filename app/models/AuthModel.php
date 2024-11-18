<?php

// Classe AuthModel

class AuthModel {

    private $bdd;

    // Constructeur

    public function __construct() {
        $bddModel = new BddModel();
        $this->bdd = $bddModel->getConnection();
    }

    // méthode pour enregistrer un utilisateur dans la base de données

    public function register($email, $nom, $prenom, $rue, $code_postal, $ville, $region, $telephone, $pays, $password) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = $this->bdd->prepare('INSERT INTO utilisateur (email, motDePasse, nom, prenom, telephone, rue, codePostal, ville, region, pays, role) VALUES (:email, :password, :nom, :prenom, :telephone, :rue, :code_postal, :ville, :region, :pays, :role)');
            $query->execute(array(
                ':email' => $email, 
                ':password' => $hashedPassword, 
                ':nom' => $nom, 
                ':prenom' => $prenom, 
                ':telephone' => $telephone, 
                ':rue' => $rue, 
                ':code_postal' => $code_postal, 
                ':ville' => $ville, 
                ':region' => $region, 
                ':pays' => $pays,
                ':role' => 'user'
            ));
            return true;
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return false;
            }
        }
    }
    
    // méthode pour connecter un utilisateur

    public function login($email, $password) {
        $query = $this->bdd->prepare('SELECT * FROM utilisateur WHERE email = :email');
        $query->execute(array(':email' => $email));
        $user = $query->fetch();
        return $user;
    }
    
}