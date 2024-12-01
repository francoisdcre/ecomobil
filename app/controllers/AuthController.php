<?php

// Classe AuthController

class AuthController {

    private $notificationController;
    private $authModel;

    // Méthode get pour afficher la page souhaiter

    public function __construct() {
        $this->notificationController = new NotificationController();
        $this->authModel = new AuthModel();
    }

    public function get() {
        if ($_SERVER['REQUEST_URI'] === '/register') {
            require_once __DIR__ . '/../views/RegisterView.php';
        } elseif ($_SERVER['REQUEST_URI'] === '/login') {
            require_once __DIR__ . '/../views/LoginView.php';
        } elseif ($_SERVER['REQUEST_URI'] === '/logout') {
            $this->logout();
        } else {
            $this->notificationController->error404();
        }
    }

    // Méthode post pour traiter les données du formulaire

    public function post() {
        if ($_SERVER['REQUEST_URI'] === '/register') {
            // Récupération des données du formulaire d'inscription
            $email = $this->sanitize_input($_POST['email']);
            $nom = $this->sanitize_input($_POST['nom']);
            $prenom = $this->sanitize_input($_POST['prenom']);
            $rue = $this->sanitize_input($_POST['rue']);
            $code_postal = $this->sanitize_input($_POST['code_postal']);
            $ville = $this->sanitize_input($_POST['ville']);
            $region = $this->sanitize_input($_POST['region']);
            $telephone = $this->sanitize_input($_POST['telephone']);
            $pays = $this->sanitize_input($_POST['pays']);
            $password = $_POST['password'];

            // Vérifier si l'email est valide

            $this->isValidEmail($email);
        
            // Vérifier si le mot de passe est valide

            $this->isValidPassword($password);
        
            // Appel de la méthode register et capture du résultat
            $result = $this->authModel->register($email, $nom, $prenom, $rue, $code_postal, $ville, $region, $telephone, $pays, $password);
        
            if ($result === true) {

                // Redirection si l'inscription est réussie

                $this->notificationController->InscriptionSuccess();
            } else {

                // Affichage de l'erreur si l'inscription a échoué

                $this->notificationController->errorRegister();
            }
        } elseif ($_SERVER['REQUEST_URI'] === '/login') {

            // $this->isBlocked();

            // Récupération des données du formulaire de connexion

            $email = $_POST['email'];
            $password = $_POST['password'];
            $user = $this->authModel->login($email, $password);

            // Vérifier si l'utilisateur existe et si le mot de passe est correct

            if ($user && password_verify($password, $user['motDePasse'])) {

                // Stocker les informations de l'utilisateur dans la session

                $this->storeUserInSession($user);

                // $_SESSION['loginAttempt'] = 0;

                // Redirection vers la page d'accueil

                header('Location: /');
            } else {
                // Affichage de l'erreur si la connexion a échoué

                // $_SESSION['loginAttempt']++;

                // $this->isBlocked();

                $this->notificationController->errorLogin();
            }
        } else {
            // Affichage de l'erreur si la page n'existe pas
            $this->notificationController->error404();
        }
    }

    // Méthode pour nettoyer les données du formulaire

    public function sanitize_input($data) {
        $data = preg_replace('/\s*<[^>]*>\s*/', '', $data);
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }

    // Méthode pour vérifier si le mot de passe est valide

    public function isValidPassword($password) {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%])[a-zA-Z\d!@#$%]{8,16}$/', $password)) {
            $this->notificationController->errorPassword();
            exit();
        }
    }

    // Méthode pour vérifier si l'email est valide

    public function isValidEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->notificationController->errorEmail();
        }
    }

    // Stocker les informations de l'utilisateur dans la session

    public function storeUserInSession($user) {
        $_SESSION['user'] = [
            'idUtilisateur' => $user['idUtilisateur'],
            'email' => $user['email'],
            'nom' => $user['nom'],
            'prenom' => $user['prenom'],
            'telephone' => $user['telephone'],
            'rue' => $user['rue'],
            'codePostal' => $user['codePostal'],
            'ville' => $user['ville'],
            'region' => $user['region'],
            'pays' => $user['pays'],
            'role' => $user['role']
        ];
    }

    // Vériier si l'utilisateur est bloqué

    // public function isBlocked() {
    //     if ($_SESSION['blocked_until'] && time() < $_SESSION['blocked_until']) {
    //         $this->notificationController->errorLoginAttempt();
    //         $_SESSION['loginAttempt'] = 0;
    //         exit();
    //     }

    //     if ($_SESSION['loginAttempt'] >= 3) {
    //         $_SESSION['blocked_until'] = time() + 20;
    //     }

    //     if (!isset($_SESSION['loginAttempt'])) {
    //         $_SESSION['loginAttempt'] = 0;
    //         $_SESSION['blocked_until'] = NULL;
    //     }
    // }

    // Méthode pour se déconnecter

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /');
    }

}