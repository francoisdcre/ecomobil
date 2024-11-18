<?php

// Classe AdminModel

Class AdminModel {
    private $bdd;

    // Constructeur

    public function __construct() {
        $bddModel = new BddModel();
        $this->bdd = $bddModel->getConnection() ;
    }

    // Méthode pour récupérer les utilisateurs

    public function getUsers() {
        $query = $this->bdd->prepare('SELECT * FROM utilisateur');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les réservations

    public function getReservation() {
        $query = $this->bdd->prepare('SELECT * FROM reservation');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les véhicules

    public function getVehicle() {
        $query = $this->bdd->prepare('SELECT * FROM vehicule where statut != "Disponible"');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les participants

    public function getParticipants() {
        $query = $this->bdd->prepare('SELECT * FROM participant');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour mettre à jour le statut d'un utilisateur

    public function updateVehicle($id, $statut) {
        $query = $this->bdd->prepare('UPDATE vehicule SET statut = :statut WHERE idVehicule = :id');
        $query->execute(array(
            ':id' => $id,
            ':statut' => $statut
        ));
    }

    // Méthode pour mettre à jour le statut d'une réservation

    public function updateReservation($id, $statut) {
        $query = $this->bdd->prepare('UPDATE reservation SET statut = :statut WHERE idReservation = :id');
        $query->execute(array(
            ':id' => $id,
            ':statut' => $statut
        ));
    }
}