<?php
    if (!isset($_SESSION['user'])) {
        header('Location: ../login');
        exit;
    }
    $reservationController = new ReservationController();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Mobil | Réservation</title>
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
                <li><a href="../vehicule" class="navbar__item--a">Vehicule</a></li>
                <li><a href="../reservation" class="navbar__item--a">Réservation</a></li>
                <li><a href="../agences" class="navbar__item--a">Agences</a></li>
            </ul>
            <ul class="navbar__links--main">
                <?php
                    if (isset($_SESSION['user'])) {
                        echo '<li><a href="../dashboard" class="button">' . $_SESSION['user']['prenom'] . '</a></li>';
                        echo '<li><a href="../logout" class="button">Logout</a></li>';
                        if ($_SESSION['user']['role'] == 'admin') {
                            echo '<li><a href="../admin" class="button">Admin</a></li>';
                        }
                    } else {
                        echo '<li><a href="../login" class="button">Login</a></li>';
                        echo '<li><a href="../register" class="button">Register</a></li>';
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
    <div class="container__reservation">
        <?php if ($reservationStep == 1) { ?>
        <form action="" method="post" class="reservation__form">
            <label for="agence">Veuillez sélectionner l'agence :</label>
            <select name="agence" id="agence" class="reservation__form--select" required>
                <option value="">--Choisir une agence--</option>
                <?php
                foreach ($agence as $city) {
                    echo '<option value="' . $city['idAgence'] . '">' . $city['ville'] . '</option>';
                }
                ?>
            </select>
            <input type="submit" value="Suivant" class="reservation__form--submit">
        </form>
        <?php } if ($reservationStep == 2) {?>
            <?php if (empty($vehiculeData)) : ?>
                <h2>Aucun véhicule disponible pour cette agence</h2>
                <a href="/reservation" class="reservation__form--submit">Retour</a>
            <?php else : ?>
                <form action="" method="post" class="reservation__form ">
                    <label>Veuillez sélectionner un véhicule :</label>
                    <div class="container__vehicule">
                        <div class="container__vehicule__wrap">
                            <?php foreach ($vehiculeData as $vehicule): ?>
                                <input type="radio" id="vehicule<?= $vehicule['idTypeVehicule'] ?>" name="reservantVehicule" value="<?= $vehicule['idTypeVehicule'] ?>" required>
                                <label for="vehicule<?= $vehicule['idTypeVehicule'] ?>" class="container__vehicule__choice--resa">
                                    <img src="../<?= $vehicule['typeVehiculeImage'] ?>" alt="<?= $vehicule['typeVehicule'] ?>">
                                    <h2><?= $vehicule['typeVehicule'] ?></h2>
                                    <table>
                                        <tr>
                                            <td>Tarif horaire</td>
                                            <td><?= $vehicule['tarifHoraire'] ?> €</td>
                                        </tr>
                                        <tr>
                                            <td>Tarif demi-journée</td>
                                            <td><?= $vehicule['tarifDemieJournee'] ?> €</td>
                                        </tr>
                                        <tr>
                                            <td>Tarif journée</td>
                                            <td><?= $vehicule['tarifJournee'] ?> €</td>
                                        </tr>
                                        <tr>
                                            <td>Disponible</td>
                                            <td><?= $vehicule['disponible_count'] ?></td>
                                        </tr>
                                    </table>
                                    <p>Réserver</p>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button type="submit">Confirmer la sélection</button>
                </form>
            <?php endif; ?>
        <?php } if ($reservationStep == 3) {?>
            <form action="" method="post" class="reservation__form">
                <label for="participant">Des participants vous accompagnent ? (4 max)</label>
                <div class="participant__option">
                    <input type="radio" name="participant" value="oui" id="participantOui" required>
                    <label for="oui">Oui</label>
                    <input type="radio" name="participant" value="non" id="participantNon" required>
                    <label for="non">Non</label>
                </div>
                <div class="participant">
                    <div class="participant__add">
                        <button type="button" onclick="addParticipant()" class="participant__add--button" id="add__participant">Ajouter un participant</button>
                        <button type="button" onclick="removeParticipant()" class="participant__remove--button" id="remove__participant">Supprimer un participant</button>
                    </div>
                    <div class="container__vehicule">
                        <h2>Insérez les informations du participants</h2>
                        <div class="participant__info">
                            <label>Email du participant</label>
                            <input type="email" name="participantEmail[]" placeholder="exemple@exemple.com" required>
                            <label>Nom du participant</label>
                            <input type="text" name="participantNom[]" placeholder="Doe" required>
                            <label>Prénom du participant</label>
                            <input type="text" name="participantPrenom[]" placeholder="John" required>
                        </div>
                        <h2>Sélectionnez le véhicule du participants</h2>
                        <div class="container__vehicule__wrap">
                            <?php foreach ($vehiculeData as $vehicule): ?>
                                <?php if ($vehicule['disponible_count'] > 0) : ?>
                                    <input type="radio" id="vehicule<?= $vehicule['idTypeVehicule'] ?>" name="participantVehicule[]" value="<?= $vehicule['idTypeVehicule'] ?>" required>
                                    <label for="vehicule<?= $vehicule['idTypeVehicule'] ?>" class="container__vehicule__choice--resa">
                                        <img src="../<?= $vehicule['typeVehiculeImage'] ?>" alt="<?= $vehicule['typeVehicule'] ?>">
                                        <h2><?= $vehicule['typeVehicule'] ?></h2>
                                        <table>
                                            <tr>
                                                <td>Tarif horaire</td>
                                                <td><?= $vehicule['tarifHoraire'] ?> €</td>
                                            </tr>
                                            <tr>
                                                <td>Tarif demi-journée</td>
                                                <td><?= $vehicule['tarifDemieJournee'] ?> €</td>
                                            </tr>
                                            <tr>
                                                <td>Tarif journée</td>
                                                <td><?= $vehicule['tarifJournee'] ?> €</td>
                                            </tr>
                                            <tr>
                                                <td>Disponible</td>
                                                <td><?= $vehicule['disponible_count'] ?></td>
                                            </tr>
                                        </table>
                                        <p>Réserver</p>
                                    </label>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <hr>
                    </div>
                </div>
                <button type="submit">Confirmer la sélection</button>
            </form>
        <?php } if ($reservationStep == 4) {?>
            <form action="" method="post" class="reservation__form">
                <label for="date">Date de réservation</label>
                <input type="date" name="date" id="date" required>
                <label for="duree">Durée de réservation</label>
                <select name="duree" id="duree" required>
                    <option value="1">1 heure</option>
                    <option value="2">2 heures</option>
                    <option value="3">3 heures</option>
                    <option value="4">Demie journée</option>
                    <option value="5">Journée</option>
                </select>
                <label for="heure">Heure de réservation</label>
                <input type="time" name="heure" id="hours" min="08:00" max="19:00" required>
                <input type="number" name="days" id="days" placeholder="Nombre de jours" value="1" min="1" style="display: none;" required>
                <button type="submit">Confirmer la réservation</button>
            </form>
        <?php } if ($reservationStep == 5) { ?>
            <form action="" method="post" class="reservation__form">
                <h2>Récapitulatif de la réservation</h2>
                    <table>
                        <tr>
                            <td>Agence</td>
                            <td><?= $reservationController->agence() ?></td>
                        </tr>
                        <tr>
                            <td>Date de réservation</td>
                            <td><?= $_SESSION['date'] ?></td>
                        </tr>
                        <tr>
                            <td>Heure de réservation</td>
                            <td><?= $_SESSION['heure'] ?></td>
                        </tr>
                        <tr>
                            <td>Durée</td>
                            <td>
                                <?= $reservationController->duree() ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Réservant</td>
                            <td><?= $_SESSION['user']['prenom'] . ' ' . $_SESSION['user']['nom'] ?></td>
                        </tr>
                        <tr>
                            <td>Véhicule du réservant</td>
                            <td>
                                <?= $reservationController->reservantVehicule(); ?>
                            </td>
                        </tr>
                        <?php $reservationController->participantArray(); ?>
                        <tr>
                            <td>Prix total</td>
                            <td>
                                <?= $reservationController->prix() ?>
                            </td>
                        </tr>
                    </table>
                    <h2>Souhaitez vous ajouter une demande spéciale ?</h2>
                    <div>
                        <input type="radio" name="demandeSpeciale" value="oui" id="demandeSpecialeOui" required>
                        <label for="demandeSpecialeOui">Oui</label>
                        <input type="radio" name="demandeSpeciale" value="non" id="demandeSpecialeNon" required>
                        <label for="demandeSpecialeNon">Non</label>
                    </div>
                    <textarea name="demandeSpecialeArea" class="demandeSpeciale" required></textarea>
                    <div class="payment__method">
                        <h2>Moyen de paiement</h2>
                        <div class="payment__method__stuff">
                            <input type="radio" name="paymentMethod" id="creditcard" value="Carte Bancaire" required>
                            <i class="fa-solid fa-credit-card" onclick="selectPaymentMethod('creditcard', 'Carte Bancaire')"></i>

                            <input type="radio" name="paymentMethod" id="paypal" value="PayPal" required>
                            <i class="fa-brands fa-paypal" onclick="selectPaymentMethod('paypal', 'PayPal')"></i>

                            <input type="radio" name="paymentMethod" id="money" value="Espèce" required>
                            <i class="fa-solid fa-money-bill" onclick="selectPaymentMethod('money', 'Espèce')"></i>

                            <input type="radio" name="paymentMethod" id="check" value="Chèque Vacances" required>
                            <i class="fa-solid fa-ticket" onclick="selectPaymentMethod('check', 'Chèque Vacances')"></i>
                        </div>

                        <div id="selectedPaymentMethod" style="margin-top: 10px; font-size: 18px;"></div>
                    </div>
                <button type="submit" name="confirm">Confirmer la réservation</button>
            </form>
        <?php } if ($reservationStep == 6) { ?>
            <h2>Votre réservation a bien été enregistrée</h2>
            <p>Vous pouvez consulter l'historique de vos réservations dans votre espace personnel en cliquant sur votre prénom dans la bar de navigation.</p>
        <?php } ?>
    </div>
    <script src="/js/participants.js"></script>
    <script src="/js/demandeSpeciale.js"></script>
    <script src="/js/duree.js"></script>
    <script>
        const today = new Date().toISOString().split("T")[0];
        document.getElementById("date").setAttribute("min", today);

        function selectPaymentMethod(method, string) {
            document.getElementById(method.toLowerCase()).checked = true;
            document.getElementById("selectedPaymentMethod").textContent = "Méthode de paiement sélectionnée : " + string;
        }

    </script>
    <script src="https://kit.fontawesome.com/01607bf9c6.js" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</body>
</html>