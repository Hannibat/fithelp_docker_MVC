    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteModal');
        var confirmDeleteButton = document.getElementById('confirmDelete');
        var exerciseIdToDelete = null;

        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            exerciseIdToDelete = button.getAttribute('data-exercise-id');
        });

        confirmDeleteButton.addEventListener('click', function() {
            if (exerciseIdToDelete) {
                // Créer et soumettre le formulaire de suppression
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '?page=exercises/delete-exercise';

                var inputPage = document.createElement('input');
                inputPage.type = 'hidden';
                inputPage.name = 'page';
                inputPage.value = 'exercises/delete-exercise';
                form.appendChild(inputPage);

                var inputExerciseId = document.createElement('input');
                inputExerciseId.type = 'hidden';
                inputExerciseId.name = 'exercise_id';
                inputExerciseId.value = exerciseIdToDelete;
                form.appendChild(inputExerciseId);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });
