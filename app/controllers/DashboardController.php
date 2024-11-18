<?php

// DashboardController.php

class DashboardController {

    // Méthode pour afficher le dashboard

    public function get() {
        if (!isset($_SESSION['user'])) {
            header('Location: /');
        }
        require_once __DIR__ . '/../views/DashboardView.php';
    }
}