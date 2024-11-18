<?php

// Classe AdminController

Class AdminController {

    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    // Méthode pour afficher la page admin

    public function get() {
        require_once __DIR__ . '/../views/AdminView.php';
    }

    // Méthode pour Update le statut d'un véhicule ou d'une réservation

    public function post() {
        if ($_GET['action'] == 'updateVehicle') {
            $id = $_POST['id'];
            $statut = $_POST['statut'];
            $this->updateVehicle($id, $statut);
        } else if ($_GET['action'] == 'updateReservation') {
            $id = $_POST['id'];
            $statut = $_POST['statut'];
            $this->updateReservation($id, $statut);
        }
    }

    // Méthode pour récupérer les utilisateurs

    public function getUsers() {
        $users = $this->adminModel->getUsers();
        return $users;
    }

    // Méthode pour récupérer les réservations

    public function getReservation() {
        $reservation = $this->adminModel->getReservation();
        return $reservation;
    }

    // Méthode pour récupérer les véhicules qui ne sont pas disponibles

    public function getVehicle() {
        $vehicle = $this->adminModel->getVehicle();
        return $vehicle;
    }

    // Méthode pour récupérer les participants

    public function getParticipants() {
        $participants = $this->adminModel->getParticipants();
        return $participants;
    }

    // Méthode pour mettre à jour le statut des véhicules

    public function updateVehicle($id, $statut) {
        $this->adminModel->updateVehicle($id, $statut);
        header('Location: /admin?action=getVehicule');
    }

    // Méthode pour mettre à jour le statut des réservations

    public function updateReservation($id, $statut) {
        $this->adminModel->updateReservation($id, $statut);
        header('Location: /admin?action=getReservation');
    }
}