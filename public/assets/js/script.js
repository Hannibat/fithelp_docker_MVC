// utilisation pour les input cachés pour la modification d'un exercice 

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('update-exercise-form');

    form.addEventListener('submit', function(event) {
        copyContentToHidden();
    });

    function copyContentToHidden() {
        const intro = document.getElementById('intro').innerHTML;
        const position = document.getElementById('position').innerHTML;
        const movement = document.getElementById('movement').innerHTML;
        const targeted_muscles = document.getElementById('targeted_muscles').innerHTML;

        document.getElementById('intro-hidden').value = intro;
        document.getElementById('position-hidden').value = position;
        document.getElementById('movement-hidden').value = movement;
        document.getElementById('targeted_muscles-hidden').value = targeted_muscles;
    }
});

// Expérience utilisateur pour le mot de passe dans formulaire

    document.addEventListener('DOMContentLoaded', function() {
        const passwordInput = document.getElementById('password');
        const confirmPasswordInput = document.getElementById('confirmPassword');

        const passwordPattern = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$/;

        passwordInput.addEventListener('input', function() {
            if (passwordPattern.test(passwordInput.value)) {
                passwordInput.classList.remove('errorField');
                passwordInput.classList.add('validField');
            } else {
                passwordInput.classList.remove('validField');
                passwordInput.classList.add('errorField');
            }
        });

        confirmPasswordInput.addEventListener('input', function() {
            if (confirmPasswordInput.value === passwordInput.value && passwordPattern.test(passwordInput.value)) {
                confirmPasswordInput.classList.remove('errorField');
                confirmPasswordInput.classList.add('validField');
            } else {
                confirmPasswordInput.classList.remove('validField');
                confirmPasswordInput.classList.add('errorField');
            }
        });
    });

// Dans profil pour calculer son imc, cacher la div et ouvrir avec le bouton
// Pour modifier le + en - lorsqu'on appuie

document.getElementById('toggleIMCForm').addEventListener('click', function() {
    var form = document.getElementById('imcForm');
    var symbol = document.getElementById('toggleSymbol');

    if (form.classList.contains('d-none')) {
        form.classList.remove('d-none');
        form.style.opacity = 1;
        symbol.textContent = '-'; // Change le symbole à -
    } else {
        form.classList.add('d-none');
        form.style.opacity = 0;
        symbol.textContent = '+'; // Change le symbole à +
    }
});

// Même chose vec le calcul des besoins caloriques journalier

document.getElementById('toggleCaloriesForm').addEventListener('click', function() {
    var form = document.getElementById('caloriesForm');
    var symbol = document.getElementById('toggleSymbolCalories');

    if (form.classList.contains('d-none')) {
        form.classList.remove('d-none');
        form.style.opacity = 1;
        symbol.textContent = '-'; // Change le symbole à -
    } else {
        form.classList.add('d-none');
        form.style.opacity = 0;
        symbol.textContent = '+'; // Change le symbole à +
    }
});

// Pour afficher/masquer la liste des exercices
document.getElementById('toggleExercises').addEventListener('click', function() {
    var exercisesList = document.getElementById('exercisesList');
    exercisesList.classList.toggle('d-none');
});

// Empêcher la page de se rafraichier lors de l'envoi du form
// document.getElementById('imcFormEvent').addEventListener('submit', function(event) {
//     event.preventDefault();
// });