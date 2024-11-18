// Participants

const participantOui = document.getElementById('participantOui');
const participantNon = document.getElementById('participantNon');
const participant = document.querySelector('.participant');

const participantVehicules = document.querySelectorAll('input[name="participantVehicule[]"]');
const participantEmails = document.querySelectorAll('input[name="participantEmail[]"]');
const participantNoms = document.querySelectorAll('input[name="participantNom[]"]');
const participantPrenoms = document.querySelectorAll('input[name="participantPrenom[]"]');

participantOui.addEventListener('click', () => {
    participant.style.display = 'flex';
    
    participantVehicules.forEach(input => input.disabled = false);
    participantEmails.forEach(input => input.disabled = false);
    participantNoms.forEach(input => input.disabled = false);
    participantPrenoms.forEach(input => input.disabled = false);
});

participantNon.addEventListener('click', () => {
    removeAllParticipant();
    participant.style.display = 'none';

    participantVehicules.forEach(input => input.disabled = true);
    participantEmails.forEach(input => input.disabled = true);
    participantNoms.forEach(input => input.disabled = true);
    participantPrenoms.forEach(input => input.disabled = true);
});

const participantContainer = document.querySelector('.participant');

let participantCount = 0;

function addParticipant() {
    if (participantCount < 3) {
        participantCount++;

        const add = document.querySelector('.container__vehicule').cloneNode(true);
    
        const radios = add.querySelectorAll('input[type="radio"]');
        radios.forEach(function(radio, index) {
            const uniqueId = `vehicule_${participantCount}_${index}`;
            radio.id = uniqueId;
            radio.name = `participantVehicule[${participantCount}]`;
    
            const label = radio.nextElementSibling;
            if (label && label.tagName === 'LABEL') {
                label.setAttribute('for', uniqueId);
            }
        });
    
        participantContainer.appendChild(add);
    } else {
        alert('Vous ne pouvez pas ajouter plus de 4 participants');
    }
}

function removeParticipant() {
    const elements = document.querySelectorAll('.container__vehicule');
    if (elements.length > 1) {
        elements[elements.length - 1].remove();
        participantCount--;
    }
}

function removeAllParticipant() {
    const elements = document.querySelectorAll('.container__vehicule');
    
    elements.forEach((element, index) => {
        if (index > 0) {
            element.remove();
        }
    });

    participantCount = 0;
}


