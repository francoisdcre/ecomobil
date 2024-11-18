const duree = document.getElementById('duree');
const days = document.getElementById('days');
const hours = document.getElementById('hours');

duree.addEventListener('change', () => {
    if (duree.value === "5") {
        days.style.display = "block";
    } else {
        days.style.display = "none";
    }

    if (duree.value === "2") {
        hours.setAttribute('max', '18:00');
    } else if (duree.value === "3") {
        hours.setAttribute('max', '17:00');
    } else if (duree.value === "4") {
        hours.setAttribute('max', '14:00');
    } else {
        hours.setAttribute('max', '19:00');
    }
});