<?php

// Classe ReservationController

class ReservationController {
    private $reservationModel;
    private $NotificationController;

    // Constructeur

    public function __construct() {
        $this->reservationModel = new ReservationModel();
        $this->NotificationController = new NotificationController();
    }

    // Affiche la vue de la réservation

    public function get() {
        $agence = $this->reservationModel->getCity();
        $this->renderView('ReservationView', ['agence' => $agence, 'reservationStep' => 1]);
    }

// Traite les données du formulaire de réservation

    public function post() {
        $reservationStep = 1;

        if (isset($_POST['agence'])) {
            $session_keys = [
                'agence', 'vehiculeData', 'reservantVehicule', 'participantVehicule',
                'participantEmail', 'participantNom', 'participantPrenom', 'date',
                'heure', 'duree', 'userVehicule', 'price', 'reservationId',
                'dateDebut', 'dateFin', 'demandeSpeciale', 'days'
            ];
            
            foreach ($session_keys as $key) {
                unset($_SESSION[$key]);
            }            
            
            $reservationStep = 2;
            $_SESSION['agence'] = $_POST['agence'];
            $_SESSION['vehiculeData'] = $this->reservationModel->getVehiculeData($_SESSION['agence']);
        } else if(isset($_POST['reservantVehicule'])) {
            $reservationStep = 3;
            $_SESSION['reservantVehicule'] = $_POST['reservantVehicule'];

            for ($i = 0; $i < count($_SESSION['vehiculeData']); $i++) {
                if ($_SESSION['vehiculeData'][$i]['idTypeVehicule'] == $_SESSION['reservantVehicule']) {
                    $_SESSION['vehiculeData'][$i]['disponible_count'] -= 1;
                }
            }
        } else if(isset($_POST['participantVehicule'], $_POST['participantEmail'], $_POST['participantNom'], $_POST['participantPrenom'])) {
            $reservationStep = 4;

            $_SESSION['participantVehicule'] = $_POST['participantVehicule'];
            $_SESSION['participantEmail'] = $_POST['participantEmail'];
            $_SESSION['participantNom'] = $_POST['participantNom'];
            $_SESSION['participantPrenom'] = $_POST['participantPrenom'];
        } else if (isset($_POST['participant'])) {
            $reservationStep = 4;
        } else if (isset($_POST['date'], $_POST['heure'], $_POST['duree'], $_POST['days'])) {
            $reservationStep = 5;
            $_SESSION['date'] = $_POST['date'];
            $_SESSION['heure'] = $_POST['heure'];
            $_SESSION['duree'] = $_POST['duree'];
            $_SESSION['days'] = $_POST['days'];

        } else if (isset($_POST['confirm'])) {
            $reservationStep = 6;

            if (isset($_SESSION['participantVehicule'])) {
                if ($this->disponibleCount() == false) {
                    $this->NotificationController->reservationError();
                    return;
                }
            }

            if (!empty($_POST['demandeSpecialeArea'])) {
                $_SESSION['demandeSpeciale'] = $_POST['demandeSpecialeArea'];
            } else {
                $_SESSION['demandeSpeciale'] = 'Aucune demande spéciale';
            }

            $_SESSION['paymentMethod'] = $_POST['paymentMethod'];

            $_SESSION['dateDebut'] = $_SESSION['date'] . ' ' . $_SESSION['heure'];
            $dateTime = new DateTime($_SESSION['dateDebut']);
            $dateTime->modify("+{$_SESSION['duree']} hours");
            $_SESSION['dateFin'] = $dateTime->format('Y-m-d H:i:s');

            $this->selectVehicule();
            $_SESSION['reservationId'] =  $this->reservationModel->confirmReservation();
            
            $this->reservationModel->addParticipant($_SESSION['user']['nom'], $_SESSION['user']['prenom'], $_SESSION['user']['email'], $_SESSION['reservantVehicule'], $_SESSION['reservationId']);

            if (isset($_SESSION['participantNom'])) {
                foreach ($_SESSION['participantNom'] as $key => $nom) {
                    $this->reservationModel->addParticipant($_SESSION['participantNom'][$key], $_SESSION['participantPrenom'][$key], $_SESSION['participantEmail'][$key], $_SESSION['participantVehicule'][$key], $_SESSION['reservationId']);
                }
            }

            foreach ($_SESSION['userVehicule'] as $vehicule) {
                $this->reservationModel->updateVehiculeStatut($vehicule);
            }
        }

        $this->renderView('ReservationView', ['vehiculeData' => $_SESSION['vehiculeData'], 'reservationStep' => $reservationStep]);
    }

    // Vérifie l'agence sélectionné par l'utilisateur pour l'afficher

    public function agence() {
        $agenceVille = $this->reservationModel->getCity();
        foreach ($agenceVille as $ville) {
            if ($_SESSION['agence'] == $ville['idAgence']) {
                return $ville['ville'];
            }
        }
    }

    // Vérifie la durée sélectionné par l'utilisateur pour l'afficher

    public function duree() {
        if ($_SESSION['duree'] == 1) {
            return '1 heure';
        } else if ($_SESSION['duree'] == 2) {
            return '2 heures';
        } else if ($_SESSION['duree'] == 3) {
            return '3 heures';
        } else if ($_SESSION['duree'] == 4) {
            $_SESSION['duree'] = 6;
            return 'Demie journée';
        } else if ($_SESSION['duree'] == 5) {
            $_SESSION['duree'] = 12;
            return 'Journée';
        }
    }

    // Vérifie le véhicule sélectionné par l'utilisateur pour l'afficher

    public function reservantVehicule() {
        foreach ($_SESSION['vehiculeData'] as $vehicule) {
            if ($vehicule['idTypeVehicule'] == $_SESSION['reservantVehicule']) {
                return $vehicule['typeVehicule'];
            }
        }
    }

    // Affiche les données des participants de la réservation

    public function participantArray() {
        if (isset($_SESSION['participantNom'])) {
            $i = 0;
            foreach ($_SESSION['participantNom'] as $nom) {
                echo '<tr>';
                echo '<td>Participant</td>';
                echo '<td>';
                echo $_SESSION['participantPrenom'][$i] . ' ' . $nom;
                echo '</tr>';
                echo '<tr>';
                echo '<td>Véhicule du participant</td>';
                echo '<td>';
                foreach ($_SESSION['vehiculeData'] as $vehicule) {
                    if ($vehicule['idTypeVehicule'] == $_SESSION['participantVehicule'][$i]) {
                        echo $vehicule['typeVehicule'];
                    }
                }
                echo '</td>';
                echo '</tr>';
                $i++;
            }
        }
    }

    // Calcul le prix en fonctioner de la durée et du véhicule sélectionné

    private function calculerPrix($vehiculeData, $idTypeVehicule, $duree) {
        foreach ($vehiculeData as $vehicule) {
            if ($vehicule['idTypeVehicule'] == $idTypeVehicule) {
                switch ($duree) {
                    case 1:
                        return $vehicule['tarifHoraire'];
                    case 2:
                        return $vehicule['tarifHoraire'] * 2;
                    case 3:
                        return $vehicule['tarifHoraire'] * 3;
                    case 6:
                        return $vehicule['tarifDemieJournee'];
                    case 12:
                        return $vehicule['tarifJournee'] * $_SESSION['days'];
                    default:
                        return 0;
                }
            }
        }
        return 0;
    }

    // Calcule prix total en fonction du réservant et des participants

    public function prix() {
        $_SESSION['price'] = 0;
        if (isset($_SESSION['participantNom'])) {
            foreach ($_SESSION['participantVehicule'] as $vehiculeParticipant) {
                $_SESSION['price'] += $this->calculerPrix($_SESSION['vehiculeData'], $vehiculeParticipant, $_SESSION['duree']);
            }
        }
        
        $_SESSION['price'] += $this->calculerPrix($_SESSION['vehiculeData'], $_SESSION['reservantVehicule'], $_SESSION['duree']);
        
        return $_SESSION['price'] . ' €';
    }

    // Sélectionne les ID des véhicules pour la réservation

    private function selectVehicule() {
        $_SESSION['userVehicule'] = [];
        $vehicule = $this->reservationModel->getIdvehicule();
    
        if (isset($_SESSION['participantVehicule'])) {
            for ($i = 0; $i < count($_SESSION['participantVehicule']); $i++) {
                foreach ($vehicule as $vehiculeId) {
                    if ($vehiculeId['idTypeVehicule'] == $_SESSION['participantVehicule'][$i] && 
                        $vehiculeId['fkIdAgence'] == $_SESSION['agence']) {
                        
                        if (!in_array($vehiculeId['idVehicule'], $_SESSION['userVehicule'])) {
                            $_SESSION['userVehicule'][] = $vehiculeId['idVehicule'];
                            break;
                        }
                    }
                }
            }
        }
    
        foreach ($vehicule as $vehiculeId) {
            if ($vehiculeId['idTypeVehicule'] == $_SESSION['reservantVehicule'] && 
                $vehiculeId['fkIdAgence'] == $_SESSION['agence']) {
                if (!in_array($vehiculeId['idVehicule'], $_SESSION['userVehicule'])) {
                    $_SESSION['userVehicule'][] = $vehiculeId['idVehicule'];
                    break;
                }
            }
        }
    
        return $_SESSION['userVehicule'];
    }

    // Affiche les réservations

    public function getReservation() {
        $reservation = $this->reservationModel->getReservation();
        return $reservation;
    }


    // Calcule le nombre de véhicule disponible pour pas en réservé plus que ce qu'il est disponible
    public function disponibleCount() {
        // Étape 1 : Compter les occurrences des IDs dans participantVehicule
        $vehiculeCounts = array_count_values($_SESSION['participantVehicule']);

        // Étape 2 : Comparer les comptes avec disponible_count
        foreach ($_SESSION['vehiculeData'] as $vehicule) {
            $idTypeVehicule = $vehicule['idTypeVehicule'];
            $disponibleCount = $vehicule['disponible_count'];

            // Vérifier si cet ID est présent dans les comptes
            if (isset($vehiculeCounts[$idTypeVehicule])) {
                $usedCount = $vehiculeCounts[$idTypeVehicule];
            } else {
                $usedCount = 0;
            }

            // Afficher le résultat
            if ($usedCount > $disponibleCount) {
                return false;
            } else {
                return true;
            }
        } 
    }

    // Affiche la vue de la réservation et envoie les données vers la page

    private function renderView($view, $data) {
        extract($data);
        require_once __DIR__ . '/../views/' . $view . '.php';
    }
}