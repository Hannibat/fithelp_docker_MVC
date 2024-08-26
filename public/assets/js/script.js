// Sélectionner partie du corps
document.addEventListener('DOMContentLoaded', function() {
    var bodyPartSelect = document.getElementById('body_part_id');
    if (bodyPartSelect) {
        bodyPartSelect.addEventListener('change', function() {
            document.getElementById('categoryFilterForm').submit();
        });
    } else {
        console.error("L'élément avec l'ID 'body_part_id' n'a pas été trouvé dans le DOM.");
    }
});

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

    if (passwordInput) {
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
    }

    if (confirmPasswordInput) {
        confirmPasswordInput.addEventListener('input', function() {
            if (confirmPasswordInput.value === passwordInput.value && passwordPattern.test(passwordInput.value)) {
                confirmPasswordInput.classList.remove('errorField');
                confirmPasswordInput.classList.add('validField');
            } else {
                confirmPasswordInput.classList.remove('validField');
                confirmPasswordInput.classList.add('errorField');
            }
        });
    }
});


// Dans profil pour calculer son imc, cacher la div et ouvrir avec le bouton
// Pour modifier le + en - lorsqu'on appuie

document.addEventListener('DOMContentLoaded', function() {
    var toggleButton = document.getElementById('toggleIMCForm');
    if (toggleButton) { // Vérification si l'élément existe
        toggleButton.addEventListener('click', function() {
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
    } else {
        console.error("L'élément avec l'ID 'toggleIMCForm' n'a pas été trouvé dans le DOM.");
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

// Pour afficher/masquer la liste des articles
document.getElementById('toggleArticles').addEventListener('click', function() {
    var articlesList = document.getElementById('articlesList');
    articlesList.classList.toggle('d-none');
});

document.querySelectorAll('.list-group-item-action').forEach(function(item) {
    item.addEventListener('click', function() {
        this.classList.toggle('active'); 
    });
});


