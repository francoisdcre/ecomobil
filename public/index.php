<?php
// Inclure l'autoloader
require_once __DIR__ . '/../core/AutoLoader.php';

// Faire durer la session plus longtemps (par exemple, 24 heures)
session_set_cookie_params(2592000);
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Instancier le contrôleur et router l'URL actuelle
$controller = new Router();
$controller->route();
include '../app/views/CookiesView.php';
