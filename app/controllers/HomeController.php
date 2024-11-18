<?php

// Classe HomeController

class HomeController {

    // Méthode pour afficher la page d'accueil
    
    public function index() {
        // Charger la vue de la page d'accueil
        require_once __DIR__ . '/../views/HomeView.php';
    }
}
