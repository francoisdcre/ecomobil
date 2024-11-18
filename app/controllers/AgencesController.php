<?php

// Classe AgencesController

class AgencesController {

    // Méthode permettant d'afficher la page des agences

    public function get() {
        require_once __DIR__ . '/../views/AgencesView.php';
    }
}