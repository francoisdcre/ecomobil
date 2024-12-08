<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Mobil | Véhicule</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/hamburgers.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar__links">
            <ul class="navbar__links--main">
                <img src="/image/logo.png" class="navbar__logo">
                <li><a href="/" class="navbar__item--a">Home</a></li>
                <li><a href="vehicule" class="navbar__item--a">Vehicule</a></li>
                <li><a href="reservation" class="navbar__item--a">Réservation</a></li>
                <li><a href="agences" class="navbar__item--a">Agences</a></li>
            </ul>
            <ul class="navbar__links--main">
                <?php
                    if (isset($_SESSION['user'])) {
                        echo '<li><a href="dashboard" class="button">' . $_SESSION['user']['prenom'] . '</a></li>';
                        echo '<li><a href="logout" class="button">Logout</a></li>';
                        if ($_SESSION['user']['role'] == 'admin') {
                            echo '<li><a href="admin" class="button">Admin</a></li>';
                        }
                    } else {
                        echo '<li><a href="login" class="button">Login</a></li>';
                        echo '<li><a href="register" class="button">Register</a></li>';
                    }
                ?>
            </ul>
        </div>
        <img src="/image/logo.png" class="logotitle">
        <h1 class="title">Eco Mobil</h1>
        <button class="hamburger hamburger--spin-r" type="button">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </button>
    </nav>
    <div class="container__vehicule">
        <h1 class="vehicule__title">Liste de nos véhicules</h1>
        <div class="container__vehicule__wrap">
            <?php foreach ($data as $vehicule): ?>
                <a href="../reservation" class="container__vehicule__choice">
                    <img src="<?= $vehicule['typeVehiculeImage'] ?>" alt="<?= $vehicule['typeVehicule'] ?>">
                    <h2><?= $vehicule['typeVehicule'] ?></h2>
                    <p>Voir si il est disponible</p>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="/js/main.js"></script>
</body>
</html>