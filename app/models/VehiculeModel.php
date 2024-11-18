<?php

// Classe VehiculeModel

class VehiculeModel {

    private $bdd;

    // Constructeur

    public function __construct() {
        $bddModel = new BddModel();
        $this->bdd = $bddModel->getConnection();
    }

    // Méthode pour récupérer les données des véhicules

    public function getData() {
        $bdd = $this->bdd;
        $query = $bdd->prepare('
            SELECT 
                tv.idTypeVehicule,
                tv.typeVehicule,
                tv.typeVehiculeImage,
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
            WHERE 
                v.statut = "Disponible"
            GROUP BY 
                tv.idTypeVehicule, tv.typeVehicule, tv.typeVehiculeImage, 
                t.tarifHoraire, t.tarifDemieJournee, t.tarifJournee');
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }


}