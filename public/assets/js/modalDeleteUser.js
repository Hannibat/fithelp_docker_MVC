    document.addEventListener('DOMContentLoaded', function() {
        var deleteModal = document.getElementById('deleteModal');
        var confirmDeleteButton = document.getElementById('confirmDelete');
        var userIdToDelete = null;

        deleteModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            userIdToDelete = button.getAttribute('data-user-id');
        });

        confirmDeleteButton.addEventListener('click', function() {
            if (userIdToDelete) {
                // Créer et soumettre le formulaire de suppression
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '?page=users/delete-user';

                var inputPage = document.createElement('input');
                inputPage.type = 'hidden';
                inputPage.name = 'page';
                inputPage.value = 'users/delete-user';
                form.appendChild(inputPage);

                var inputUserId = document.createElement('input');
                inputUserId.type = 'hidden';
                inputUserId.name = 'user_id';
                inputUserId.value = userIdToDelete;
                form.appendChild(inputUserId);

                document.body.appendChild(form);
                form.submit();
            }
        });
    });
