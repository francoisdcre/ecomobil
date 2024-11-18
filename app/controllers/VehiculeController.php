<?php

// Classe VehiculeController

class VehiculeController {

    // Méthode pour afficher la liste des véhicules

    public function get() {
        $vehiculeModel = new VehiculeModel();
        $_SESSION['data'] = $vehiculeModel->getData();
        // $city = $vehiculeModel->getCity();
        $this->renderView('VehiculeView', $_SESSION['data']);
    }

    // Méthode pour afficher la page de la liste des véhicules et qui envoie les données à la vue

    private function renderView($view, $data) {
        extract($data);
        // extract($city);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}