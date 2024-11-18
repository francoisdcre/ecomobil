<?php
class Router {

    public function route() {
        // Récupérer l'URL actuelle
        $url = $_SERVER['REQUEST_URI'];

        // Extraire et nettoyer l'URL
        $parsed_url = trim(parse_url($url, PHP_URL_PATH), '/');

        // Récupérer la méthode HTTP
        $method = $_SERVER['REQUEST_METHOD'];
        
        // Générer le chemin absolu du dossier controllers
        $base = realpath(__DIR__ . '/../app/controllers/') . '/';

        // Redirection des routes spécifiques vers AuthController
        switch ($parsed_url) {
            case 'register':
            case 'login':
            case 'logout':
                $controller = 'AuthController';
                break;
            case 'vehicule/reservation':
                // Appeler la méthode reservation dans VehiculeController
                $controller = 'ReservationController';
                break;
            case 'admin':
                // Appeler la méthode get dans AdminController
                $controller = 'AdminController';
                break;
            default:
                $controller = ucfirst($parsed_url) . 'Controller';
                break;
        }

        // Générer le chemin vers le fichier du contrôleur
        $path = $base . $controller . '.php';

        // Si l'URL est vide, on charge le contrôleur de la page d'accueil
        if (empty($parsed_url)) {
            $homeController = new HomeController();
            $homeController->index();
            return;
        }

        // Vérifier si le fichier du contrôleur existe
        if (file_exists($path)) {
            require_once $path;
            $controllerInstance = new $controller();

            // Appeler la méthode selon la méthode HTTP
            if ($method === 'POST') {
                if (method_exists($controllerInstance, 'post')) {
                    $controllerInstance->post();
                } else {
                    echo "Méthode POST non définie pour ce contrôleur.";
                }
            } else {
                if (method_exists($controllerInstance, 'get')) {
                    $controllerInstance->get();
                } else {
                    echo "Méthode GET non définie pour ce contrôleur.";
                }
            }
        } else {
            // Si le fichier du contrôleur n'existe pas, on charge la page 404
            $error = new NotificationController();
            $error->error404();
        }
    }
}
