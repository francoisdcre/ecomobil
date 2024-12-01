<?php
    if (!isset($_SESSION['user'])) {
        header('Location: /');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Mobil | Compte</title>
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
    <div class="dashboard__container">
        <h1 class="dashboard__container__title">Votre Compte</h1>
        <div class="dashboard__container__info">
            <div class="dashboard__container__info--list">
                <label for="prenom" class="dashboard__label">Prénom :</label>
                <input type="text" id="prenom" class="dashboard__input" value="<?php echo $_SESSION['user']['prenom']; ?>" disabled />

                <label for="nom" class="dashboard__label">Nom :</label>
                <input type="text" id="nom" class="dashboard__input" value="<?php echo $_SESSION['user']['nom']; ?>" disabled />

                <label for="email" class="dashboard__label">Email :</label>
                <input type="email" id="email" class="dashboard__input" value="<?php echo $_SESSION['user']['email']; ?>" disabled />

                <label for="telephone" class="dashboard__label">Téléphone :</label>
                <input type="text" id="telephone" class="dashboard__input" value="<?php echo $_SESSION['user']['telephone']; ?>" disabled />
            </div>
            <div class="dashboard__container__info--list">
                <label for="rue" class="dashboard__label">Rue :</label>
                <input type="text" id="rue" class="dashboard__input" value="<?php echo $_SESSION['user']['rue']; ?>" disabled />

                <label for="ville" class="dashboard__label">Ville :</label>
                <input type="text" id="ville" class="dashboard__input" value="<?php echo $_SESSION['user']['codePostal'] . ', ' . $_SESSION['user']['ville']; ?>" disabled />

                <label for="region" class="dashboard__label">Région :</label>
                <input type="text" id="region" class="dashboard__input" value="<?php echo $_SESSION['user']['region']; ?>" disabled />

                <label for="pays" class="dashboard__label">Pays :</label>
                <input type="text" id="pays" class="dashboard__input" value="<?php echo $_SESSION['user']['pays']; ?>" disabled />
            </div>
        </div>

        <div class="dashboard__reservation">
            <h1 class="dashboard__reservation__title">Vos réservations</h1>
            <div class="dashboard__reservation__list">
                <table class="dashboard__reservation__table">
                    <thead>
                        <tr>
                            <th>Id Réservation</th>
                            <th>Agence</th>
                            <th>Date de début</th>
                            <th>Date de fin</th>
                            <th>Statut</th>
                            <th>Demande spéciale</th>
                            <th>Moyen de paiement</th>
                            <th>Montant</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $reservationController = new ReservationController();
                        $reservation = $reservationController->getReservation();
                        foreach ($reservation as $reservations) {
                            echo '<tr>';
                            echo '<td>' . $reservations['idReservation'] . '</td>';
                            echo '<td>' . $reservations['nomAgence'] . '</td>';
                            echo '<td>' . $reservations['dateDebut'] . '</td>';
                            echo '<td>' . $reservations['dateFin'] . '</td>';
                            echo '<td>' . $reservations['statut'] . '</td>';
                            echo '<td>' . $reservations['demandeSpeciale'] . '</td>';
                            echo '<td>' . $reservations['moyenPaiement'] . '</td>';
                            echo '<td>' . $reservations['montant'] . '€ </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="/js/main.js"></script>

</body>
</html>