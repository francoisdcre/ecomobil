<?php
    if (!isset($_SESSION['user'])) {
        if ($_SESSION['user']['role'] !== 'admin') {
            header('Location: /');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="sidebar">
        <a href="/" class="sidebar__item"><i class="fa-solid fa-house"></i>Home</a>
        <a href="admin" class="sidebar__item"><i class="fa-solid fa-house-user"></i>Panel Admin</a>
        <a href="admin?action=getVehicule" class="sidebar__item"><i class="fa-solid fa-bicycle"></i>Vehicule</a>
        <a href="admin?action=getReservation" class="sidebar__item"><i class="fa-solid fa-sheet-plastic"></i>Réservations</a>
        <a href="admin?action=getUsers" class="sidebar__item"><i class="fa-solid fa-user"></i>Users</a>
        <a href="admin?action=getParticipants" class="sidebar__item"><i class="fa-regular fa-user"></i>Participants</a>
    </div>
    <div class="main">
        <?php
            $adminController = new AdminController();
            if (isset($_GET['action'])) : ?>
                <?php if ($_GET['action'] == 'getUsers') : ?>
                    <?php $users = $adminController->getUsers(); ?>
                    <h1>Utilisateurs</h1>
                    <div class="table__container">
                        <table class="table__admin">
                            <tr>
                                <th>Id</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>Ville</th>
                                <th>Role</th>
                            </tr>
                            <?php
                                foreach ($users as $user) {
                                    echo '<tr>';
                                    echo '<td>' . $user['idUtilisateur'] . '</td>';
                                    echo '<td>' . $user['prenom'] . '</td>';
                                    echo '<td>' . $user['nom'] . '</td>';
                                    echo '<td>' . $user['email'] . '</td>';
                                    echo '<td>' . $user['ville'] . '</td>';
                                    echo '<td>' . $user['role'] . '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </table>
                    </div>
                <?php elseif ($_GET['action'] == 'getReservation') : ?>
                    <?php $reservation = $adminController->getReservation(); ?>
                    <h1>Réservations</h1>
                    <div class="table__container">
                        <table class="table__admin">
                            <tr>
                                <th>Id</th>
                                <th>Id Utilisateur</th>
                                <th>Agence</th>
                                <th>Date de début</th>
                                <th>Date de fin</th>
                                <th>Statut</th>
                                <th>Montant</th>
                                <th>Moyen de paiement</th>
                                <th>Demande Spéciale</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                foreach ($reservation as $resa) {
                                    echo '<tr>';
                                    echo '<td>' . $resa['idReservation'] . '</td>';
                                    echo '<td>' . $resa['fkIdUtilisateur'] . '</td>';
                                    echo '<td>' . $resa['nomAgence'] . '</td>';
                                    echo '<td>' . $resa['dateDebut'] . '</td>';
                                    echo '<td>' . $resa['dateFin'] . '</td>';
                                    echo '<td>' . $resa['statut'] . '</td>';
                                    echo '<td>' . $resa['montant'] . '</td>';
                                    echo '<td>' . $resa['moyenPaiement'] . '</td>';
                                    echo '<td>' . $resa['demandeSpeciale'] . '</td>';
                                    echo '<td> <a href="admin?action=updateReservation&id=' . $resa['idReservation'] . '"> Mettre à jour </a></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </table>
                    </div>
                <?php elseif ($_GET['action'] == 'updateReservation') : ?>
                    <?php $idReservation = $_GET['id']; ?>
                    <div class="update">
                        <h1>Mettre à jour la réservation</h1>
                        <form action="" method="POST" class="update__form">
                            <div class="form__element">
                                <label for="id">Id</label>
                                <input type="number" name="id" value="<?php echo $idReservation; ?>" readonly>
                            </div>
                            <div class="form__element">
                                <label for="statut">Statut</label>
                                <select name="statut" id="statut">
                                    <option value="En cours">En cours</option>
                                    <option value="Terminée">Terminée</option>
                                    <option value="Annulée">Annulée</option>
                                </select>
                            </div>
                            <input type="submit" value="Mettre à jour">
                        </form>
                    </div>
                <?php elseif ($_GET['action'] == 'getVehicule') : ?>
                    <?php $vehicle = $adminController->getVehicle(); ?>
                    <h1>Vehicules réservé</h1>
                    <div class="table__container">
                        <table class="table__admin">
                            <tr>
                                <th>Id</th>
                                <th>Statut</th>
                                <th>fkIdTypeVehicule</th>
                                <th>Agence</th>
                                <th>Action</th>
                            </tr>
                            <?php
                                foreach ($vehicle as $vehicule) {
                                    echo '<tr>';
                                    echo '<td>' . $vehicule['idVehicule'] . '</td>';
                                    echo '<td>' . $vehicule['statut'] . '</td>';
                                    echo '<td>' . $vehicule['fkIdTypeVehicule'] . '</td>';
                                    echo '<td>' . $vehicule['nomAgence'] . '</td>';
                                    echo '<td> <a href="admin?action=updateVehicle&id=' . $vehicule['idVehicule'] . '"> Mettre à jour </a></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </table>
                    </div>
                <?php elseif ($_GET['action'] == 'updateVehicle') : ?>
                    <?php $idVehicule = $_GET['id']; ?>
                    <div class="update">
                        <h1>Mettre à jour le statut du véhicule</h1>
                        <form action="" method="POST" class="update__form">
                            <div class="form__element">
                                <label for="id">Id</label>
                                <input type="number" name="id" value="<?php echo $idVehicule; ?>" readonly>
                            </div>
                            <div class="form__element">
                                <label for="statut">Statut</label>
                                <select name="statut" id="statut">
                                    <option value="Disponible">Disponible</option>
                                    <option value="En réparation">En réparation</option>
                                </select>
                            </div>
                            <input type="submit" value="Mettre à jour">
                        </form>
                    </div>
                <?php elseif ($_GET['action'] == 'getParticipants') : ?>
                    <?php $participants = $adminController->getParticipants(); ?>
                    <h1>Participants</h1>
                    <div class="table__container">
                        <table class="table__admin">
                            <tr>
                                <th>Id</th>
                                <th>Prénom</th>
                                <th>Nom</th>
                                <th>Email</th>
                                <th>fkIdVehicule</th>
                                <th>fkIdReservation</th>
                            </tr>
                            <?php
                                foreach ($participants as $participant) {
                                    echo '<tr>';
                                    echo '<td>' . $participant['idParticipant'] . '</td>';
                                    echo '<td>' . $participant['prenom'] . '</td>';
                                    echo '<td>' . $participant['nom'] . '</td>';
                                    echo '<td>' . $participant['email'] . '</td>';
                                    echo '<td>' . $participant['fkIdVehicule'] . '</td>';
                                    echo '<td>' . $participant['fkIdReservation'] . '</td>';
                                    echo '</tr>';
                                }
                            ?>
                        </table>
                    </div>
                <?php endif; ?>
            <?php else : ?>
                <h1>Panel Admin</h1>
                <div class="bento__box">
                    <a href="admin?action=getVehicule" class="bento">
                        <i class="fa-solid fa-bicycle"></i>
                        <h2>Véhicules</h2>
                    </a>
                    <a href="admin?action=getReservation" class="bento">
                        <i class="fa-solid fa-sheet-plastic"></i>
                        <h2>Réservations</h2>
                    </a>
                    <a href="admin?action=getUsers" class="bento">
                        <i class="fa-solid fa-user"></i>
                        <h2>Utilisateurs</h2>
                    </a>
                    <a href="admin?action=getParticipants" class="bento">
                        <i class="fa-regular fa-user"></i>
                        <h2>Participants</h2>
                    </a>
                </div>
            <?php endif; ?>
    </div>
    <script src="https://kit.fontawesome.com/01607bf9c6.js" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</body>
</html>