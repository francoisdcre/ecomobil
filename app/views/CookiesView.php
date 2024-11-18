<link rel="stylesheet" href="/css/styles.css">

<div id="cookie-banner">
    <p>
        Nous utilisons des cookies pour améliorer votre expérience sur notre site et garder vos informations de connexion. 
        <a href="#">En savoir plus</a>.
    </p>
    <button id="accept-cookies">Accepter</button>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        if (!getCookie("cookieConsentEcomobil")) {
            document.getElementById("cookie-banner").style.display = "block";
        }

        document.getElementById("accept-cookies").addEventListener("click", function() {
            setCookie("cookieConsentEcomobil", "true", 365);
            document.getElementById("cookie-banner").style.display = "none";
        });
    });

    function setCookie(name, value, days) {
        var expires = "";
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toUTCString();
        }
        document.cookie = name + "=" + (value || "") + expires + "; path=/";
    }

    function getCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }
</script>
