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
    <title>Eco Mobil | Authentification</title>
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
    <form action="" method="post" class="form--login">
        <h1 class="form__title">Connexion</h1>
        <div class="form__container">
            <div class="form__split--login">
                <div class="form__group">
                    <label for="email" class="form__label">Email</label>
                    <input type="email" name="email" id="email" class="form__input" placeholder="exemple@exemple.com" required>
                </div>
                <div class="form__group">
                    <label for="password" class="form__label">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form__input" required>
                </div>
                <button type="submit" class="form__button">Connexion</button>
            </div>
        </div>
    </form>
    <script src="/js/main.js"></script>
</body>
</html>