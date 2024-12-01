<?php

// Classe ReservationModel

class ReservationModel {
    private $bdd;

    // Constructeur

    public function __construct() {
        $bddModel = new BddModel();
        $this->bdd = $bddModel->getConnection();
    }

    // Méthode pour récupérer toutes les villes des agences

    public function getCity() {
        $bdd = $this->bdd;
        $query = $bdd->prepare('
            SELECT 
                ville,
                idAgence
            FROM 
                agences');
        $query->execute();
        $city = $query->fetchAll();
        return $city;
    }

    // Méthode pour récupérer les données des véhicules

    public function getVehiculeData($agence) {
        $query = $this->bdd->prepare('
            SELECT 
                tv.idTypeVehicule,
                tv.typeVehicule,
                tv.typeVehiculeImage,
                tv.fkIdTarif,
                t.tarifHoraire,
                t.tarifDemieJournee,
                t.tarifJournee,
                COUNT(v.statut) AS disponible_count
            FROM 
                vehicule v
            JOIN 
                typeVehicule tv ON v.fkIdTypeVehicule = tv.idTypeVehicule
            JOIN 
                tarification t ON tv.fkIdTarif = t.idTarif
            JOIN 
                agences a ON v.fkIdAgence = a.idAgence
            WHERE 
                v.statut = "Disponible"
                AND a.idAgence = :agence
            GROUP BY 
                tv.idTypeVehicule, tv.typeVehicule, tv.typeVehiculeImage, 
                t.tarifHoraire, t.tarifDemieJournee, t.tarifJournee');
        $query->execute(array(':agence' => $agence));
        $data = $query->fetchAll();
        return $data;
    }

    // Méthode pour récupérer les données des véhicules disponibles

    public function getIdvehicule() {
        $query = $this->bdd->prepare("
            SELECT 
                v.idVehicule,
                v.fkIdAgence,
                tv.idTypeVehicule
            FROM
                vehicule v
            INNER JOIN
                typeVehicule tv ON v.fkIdTypeVehicule = tv.idTypeVehicule
            INNER JOIN
                agences a ON v.fkIdAgence = idAgence
            WHERE
                v.statut = 'Disponible'
            ORDER BY
                idVehicule ASC");
        $query->execute();
        $idvehicule = $query->fetchAll();
        return $idvehicule;
    }

    // Méthode pour insérer la réservation dans la base de données

    public function confirmReservation() {
        $query = $this->bdd->prepare('
            INSERT INTO
                reservation (dateDebut, dateFin, statut, montant, demandeSpeciale, moyenPaiement, fkIdUtilisateur)
            VALUES
                (:dateDebut, :dateFin, :statut, :montant, :demandeSpeciale, :moyenPaiement, :fkIdUtilisateur)');
        $query->execute(array(
            ':dateDebut' => $_SESSION['dateDebut'],
            ':dateFin' => $_SESSION['dateFin'],
            ':statut' => 'En cours',
            ':montant' => $_SESSION['price'],
            ':demandeSpeciale' => $_SESSION['demandeSpeciale'],
            ':moyenPaiement' => $_SESSION['paymentMethod'],
            ':fkIdUtilisateur' => $_SESSION['user']['idUtilisateur']
        ));
        return $this->bdd->lastInsertId();
    }

    // Méthode pour insérer les participants dans la base de données

    public function addParticipant($nom, $prenom, $email, $vehicule, $reservation) {
        $query = $this->bdd->prepare('
            INSERT INTO
                participant (nom, prenom, email, fkIdVehicule, fkIdReservation)
            VALUES
                (:nom, :prenom, :email, :fkIdVehicule, :fkIdReservation)');

        $query->execute(array(
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':fkIdVehicule' => $vehicule,
            ':fkIdReservation' => $reservation
        ));
        return true;
    }

    // Méthode pour mettre à jour le statut du véhicule

    public function updateVehiculeStatut($vehicule) {
        $query = $this->bdd->prepare('
            UPDATE
                vehicule
            SET
                statut = "Réservé"
            WHERE
                idVehicule = :idVehicule');
        $query->execute(array(':idVehicule' => $vehicule));
        return true;
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
            WHERE 
                r.fkIdUtilisateur = :fkIdUtilisateur
            GROUP BY
                r.idReservation');
        $query->execute(array(
            
            ':fkIdUtilisateur' => $_SESSION['user']['idUtilisateur']
        ));
        $reservation = $query->fetchAll();
        return $reservation;
    }
}