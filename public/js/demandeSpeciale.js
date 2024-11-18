// Demande spéciale

const demandeSpecialeOui = document.getElementById('demandeSpecialeOui');
const demandeSpecialeNon = document.getElementById('demandeSpecialeNon');
const demandeSpeciale = document.querySelector('.demandeSpeciale');

demandeSpecialeOui.addEventListener('click', () => {
    demandeSpeciale.style.display = 'block';
    demandeSpeciale.disabled = false;
});

demandeSpecialeNon.addEventListener('click', () => {
    demandeSpeciale.style.display = 'none';
    demandeSpeciale.disabled = true;
});