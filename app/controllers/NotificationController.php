<?php

// Class NotificationController

class NotificationController  {

    // Affichage de l'inscription réussie
    public function InscriptionSuccess() {
        $title = "Inscription réussie !";
        $error = "";
        $message = "Inscription réussie !";
        require_once __DIR__ . '/../views/NotificationView.php';
    }

    // Affichage de l'erreur 404

    public function error404() {
        $title = "Erreur 404";
        $error = "Erreur 404";
        $message = "La page demandée n'existe pas.";
        require_once __DIR__ . '/../views/NotificationView.php';
    }

    // Affichage de l'erreur lors de l'inscription

    public function errorRegister() {
        $title = "Erreur d'inscription";
        $error = "Erreur lors de l'enregistrement.";
        $message = "L'adresse e-mail existe déjà.";
        require_once __DIR__ . '/../views/NotificationView.php';
    }

    // Affichage de l'erreur lors de la connexion

    public function errorLogin() {
        $title = "Erreur de connexion";
        $error = "Erreur lors de la connexion.";
        $message = "L'adresse e-mail ou le mot de passe est incorrect.";
        require_once __DIR__ . '/../views/NotificationView.php';
    }

    // Affichage de l'erreur si l'utilisateur n'est pas connecté

    public function isConnected() {
        $title = 'Erreur';
        $error = 'Vous devez être connecté pour accéder à cette page.';
        $message = 'Veuillez vous connecter.';
        require_once __DIR__ . '/../views/NotificationView.php';
    }

    // Affichage de l'erreur si le mot de passe ne convient pas lors de son incritpion

    public function errorPassword() {
        $title = 'Erreur';
        $error = 'Erreur lors de l\'inscription.';
        $message = 'Le mot de passe doit contenir au moins 8 caractères et au plus 16 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.';
        require_once __DIR__ . '/../views/NotificationView.php';
    }

    // Affichage de l'erreur si l'adresse e-mail n'est pas valide

    public function errorEmail() {
        $title = 'Erreur';
        $error = 'Erreur lors de l\'inscription.';
        $message = 'L\'adresse e-mail n\'est pas valide.';
        require_once __DIR__ . '/../views/NotificationView.php';
    }

    // Affichage de l'erreur si la réservation a échoué

    public function reservationError() {
        $title = 'Erreur';
        $error = 'Erreur lors de la réservation.';
        $message = 'Vous avez sélectionné des véhicules qui ne sont pas disponibles.';
        require_once __DIR__ . '/../views/NotificationView.php';
    }


    public function errorLoginAttempt() {
        $title = 'Erreur';
        $error = 'Erreur lors de la connexion.';
        $message = 'Vous avez essayé de vous connecter trop de fois. Veuillez réessayer plus tard.';
        require_once __DIR__ . '/../views/NotificationView.php';
    }
}