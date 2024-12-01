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
        $query = $this->bdd->prepare('
        SELECT 
            r.*,
            a.nom AS nomAgence
        FROM 
            reservation r
        JOIN 
            participant p ON r.idReservation = p.fkIdReservation
        JOIN 
            vehicule v ON p.fkIdVehicule = v.idVehicule
        JOIN 
            agences a ON v.fkIdAgence = a.idAgence
        GROUP BY 
            r.idReservation;');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    // Méthode pour récupérer les véhicules

    public function getVehicle() {
        $query = $this->bdd->prepare('
        SELECT 
            v.*,
            a.nom AS nomAgence
        FROM 
            vehicule v
        JOIN 
            agences a ON v.fkIdAgence = a.idAgence
        WHERE 
            v.statut != "Disponible";');
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