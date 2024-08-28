// Script pour ouvrir/fermer la modal
const modal = document.getElementById("contactModal");
    const buttonText = document.getElementById("contactButtonText");
    const buttonIcon = document.getElementById("contactButtonIcon");
    const span = document.getElementsByClassName("contact-modal-close")[0];
    const flashMessage = document.getElementById("flashMessage");

    buttonText.onclick = function(event) {
        event.preventDefault();
        modal.style.display = "block";
    }

    buttonIcon.onclick = function(event) {
        event.preventDefault();
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Fonction pour afficher un message flash
    function showFlashMessage(message, isError = false) {
        flashMessage.textContent = message;
        flashMessage.classList.remove('flash-error');
        if (isError) {
            flashMessage.classList.add('flash-error');
        }
        flashMessage.style.display = 'block';
        setTimeout(function() {
            flashMessage.style.display = 'none';
        }, 5000); // Le message disparaît après 5 secondes
    }

// Fonction d'envoi du formulaire avec EmailJS
document.getElementById('contactForm').addEventListener('submit', function(event) {
    event.preventDefault();
    emailjs.sendForm('service_4ectg97', 'template_66sccwa', this)
            .then(function() {
            showFlashMessage('Message envoyé avec succès !');
            modal.style.display = "none";
        }, function(error) {
            showFlashMessage('Erreur lors de l\'envoi du message : ' + error.text, true);
        });
});

emailjs.init("ztkG0McU1amELg379");

