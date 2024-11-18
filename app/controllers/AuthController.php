<?php

// Classe AuthController

class AuthController {

    // Méthode get pour afficher la page souhaiter

    public function get() {
        if ($_SERVER['REQUEST_URI'] === '/register') {
            require_once __DIR__ . '/../views/RegisterView.php';
        } elseif ($_SERVER['REQUEST_URI'] === '/login') {
            require_once __DIR__ . '/../views/LoginView.php';
        } elseif ($_SERVER['REQUEST_URI'] === '/logout') {
            $this->logout();
        } else {
            $error = new NotificationController();
            $error->error404();
        }
    }

    // Méthode pour nettoyer les données du formulaire

    function sanitize_input($data) {
        $data = preg_replace('/\s*<[^>]*>\s*/', '', $data);
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
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

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = new NotificationController();
                $error->errorEmail();
                exit();
            }
        
            // Vérifier si le mot de passe est valide

            if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_])[a-zA-Z\d\W_]{8,16}$/', $password)) {
                $error = new NotificationController();
                $error->errorPassword();
                exit();
            }

            // Création d'une instance du modèle
            $register = new AuthModel();
        
            // Appel de la méthode register et capture du résultat
            $result = $register->register($email, $nom, $prenom, $rue, $code_postal, $ville, $region, $telephone, $pays, $password);
        
            if ($result === true) {
                // Redirection si l'inscription est réussie
                $success = new NotificationController();
                $success->InscriptionSuccess();
            } else {
                // Affichage de l'erreur si l'inscription a échoué
                $error = new NotificationController();
                $error->errorRegister();
            }
        } elseif ($_SERVER['REQUEST_URI'] === '/login') {
            // Récupération des données du formulaire de connexion
            $email = $_POST['email'];
            $password = $_POST['password'];
            $register = new AuthModel();
            $user = $register->login($email, $password);

            // Vérifier si l'utilisateur existe et si le mot de passe est correct
            if ($user && password_verify($password, $user['motDePasse'])) {

                // Stocker les informations de l'utilisateur dans la session
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

                // Régénérer l'identifiant de session
                session_regenerate_id(true);

                // Redirection vers la page d'accueil
                header('Location: /');
            } else {
                // Affichage de l'erreur si la connexion a échoué
                $error = new NotificationController();
                $error->errorLogin();
            }
        } else {
            // Affichage de l'erreur si la page n'existe pas
            $error = new NotificationController();
            $error->error404();
        }
    }

    // Méthode pour se déconnecter

    public function logout() {
        session_start();
        session_destroy();
        header('Location: /');
    }

}