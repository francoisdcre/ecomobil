<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Mobil | Accueil</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/responsive.css">
    <link rel="stylesheet" href="/css/hamburgers.css">
</head>
<body class="home">
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
    <div class="container">
        <div class="container__info">
            <div class="container__info__title">
                <h1 class="container__info--title">Eco Mobil, moyen de déplacement <span style="color: #3bb96d">écologique</span></h1>
            </div>
            <div class="container__info__description">
                <p class="container__info--description">Louez un véhicule électrique sur courte durée, disponible en Auvergne Rhône-ALpes. <a href="">En savoir plus</a></p>
            </div>
            <div class="container__info__stats">
                <div class="container__info__stats--info">
                    <p style="color: var(--main-green)">5000+</p>
                    <p>Utilisateurs</p>
                </div>
                <div class="container__info__stats--info">
                    <p style="color: var(--main-blue)">300+</p>
                    <p>Véhicules</p>
                </div>
                <div class="container__info__stats--info">
                    <p style="color: var(--main-blue)">4.8★</p>
                    <P>Satisfaction</P>
                </div>
            </div>
        </div>
        <div class="container__logo">
            <img src="/image/logo.png" class="container__logo--img">
        </div>
    </div>
    <img src="/image/lotus.png" class="lotus" alt="lotus">
    <img src="/image/lotus.png" class="lotus" alt="lotus">
    <script src="/js/main.js"></script>
</body>
</html>
