<?php
    if (isset($_SESSION['user'])) {
        header('Location: /');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Mobil | Création de compte</title>
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
    <div class="container">
        <form action="" method="post" class="form">
            <h1 class="form__title">Nouveau compte</h1>
            <div class="form__container">
                <div class="form__split">
                    <div class="form__group">
                        <label for="email" class="form__label">Email</label>
                        <input type="email" name="email" id="email" class="form__input" placeholder="exemple@exemple.com" required>
                    </div>
                    <div class="form__group">
                        <label for="nom" class="form__label">Nom</label>
                        <input type="text" name="nom" id="nom" class="form__input" placeholder="Doe" required>
                    </div>
                    <div class="form__group">
                        <label for="prenom" class="form__label">Prenom</label>
                        <input type="text" name="prenom" id="prenom" class="form__input" placeholder="John" required>
                    </div>
                    <div class="form__group">
                        <label for="rue" class="form__label">Rue</label>
                        <input type="text" name="rue" id="rue" class="form__input" placeholder="12 rue de la république" required>
                    </div>
                    <div class="form__group">
                        <label for="telephone" class="form__label">Téléphone</label>
                        <input type="tel" id="telephone" name="telephone" class="form__input" pattern="^(\d{2}(\s|-)?){4}\d{2}$" placeholder="01 23 45 67 89" required>
                    </div>
                </div>
                <div class="form__split">
                    <div class="form__group">
                        <label for="code_postal" class="form__label">Code Postal</label>
                        <input type="text" name="code_postal" id="code_postal" class="form__input" pattern="^\d{5}$" placeholder="75001" required>
                    </div>
                    <div class="form__group">
                        <label for="ville" class="form__label">Ville</label>
                        <input type="text" name="ville" id="ville" class="form__input" placeholder="Paris" required>
                    </div>
                    <div class="form__group">
                        <label for="region" class="form__label">Region</label>
                        <input type="text" name="region" id="region" class="form__input" placeholder="Île-de-France" required>
                    </div>
                    <div class="form__group">
                        <label for="pays" class="form__label">Pays</label>
                        <input type="text" name="pays" id="pays" class="form__input" placeholder="France" required>
                    </div>
                    <div class="form__group">
                        <label for="password" class="form__label">Password</label>
                        <input type="password" name="password" id="password" class="form__input" required>
                    </div>
                </div>
            </div>
            <button type="submit" class="form__button">Register</button>
        </form>
    </div>
    <script src="/js/main.js"></script>
</body>
</html>