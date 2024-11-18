<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Mobil | Agences</title>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
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
    <div class="container__map">
        <h1 class="container__map__title">Nos agences</h1>
        <div class="container__map--extend">
            <div id="map"></div>
            <div class="container__map__list">
                <ul class="container__map__list--box">
                    <li class="container__map__list--item">Annecy</li>
                    <p>Rue d'Annecy 1, 74000</p>
                    <li class="container__map__list--item">Grenoble</li>
                    <p>Rue de Grenoble 1, 38000</p>
                    <li class="container__map__list--item">Lyon</li>
                    <p>Rue de Lyon 1, 69000</p>
                    <li class="container__map__list--item">Valence</li>
                    <p>Rue de Valence 1, 26000</p>
                </ul>
            </div>
        </div>
    </div>
    <script>
        // Initialiser la carte et définir ses coordonnées de centre et niveau de zoom
        var map = L.map('map').setView([45.5225, 5.3488], 8);

        // Ajouter les tuiles OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Tableau d'adresses avec latitude et longitude
        var locations = [
            {lat: 45.1861, lng: 5.7189, title: 'Grenoble'},
            {lat: 45.7605, lng: 4.8366, title: 'Lyon'},
            {lat: 44.9287, lng: 4.8995, title: 'Valence'},
            {lat: 45.8993, lng: 6.1298, title: 'Annecy'}
        ];

        // Ajouter des marqueurs pour chaque adresse
        locations.forEach(function(location) {
            L.marker([location.lat, location.lng]).addTo(map)
                .bindPopup(location.title)
                .openPopup();
        });
    </script>
    <script src="/js/main.js"></script>

</body>
</html>