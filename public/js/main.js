const hamburger = document.querySelector('.hamburger');
const navbar = document.querySelector('.navbar__links');

hamburger.addEventListener('click', () => {
    hamburger.classList.toggle('is-active');

    // Vérifiez l'état de `navbar` et alternez `right` en conséquence
    if (navbar.style.right === "-100%" || !navbar.style.right) {
        navbar.style.right = "0";
        hamburger.style.right = "65px";
    } else {
        hamburger.style.right = "0";
        navbar.style.right = "-100%";
    }
});
