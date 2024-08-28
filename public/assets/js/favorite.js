    const dataFetchJs= document.querySelectorAll('.data-fetch-js');
    for (let exercise of dataFetchJs) {
        const exerciseId=exercise.querySelector('.exercise_id').value;
        const heart = exercise.querySelector('.heart');
        heart.addEventListener('click',() => toggleFavorite(exerciseId, heart))
    }
    function toggleFavorite(exerciseId,heart) {
        const currentSrc = heart.getAttribute('src');
        const newSrc = currentSrc.includes('heart_empty.png') ? '/public/assets/img/heart.png' : '/public/assets/img/heart_empty.png';

        // Envoyer une requête POST pour mettre à jour le statut favori
        fetch('?page=users/update-favorite', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({
                'exercise_id': exerciseId,
                'action': newSrc.includes('heart_empty.png') ? 'remove' : 'add'
            })
        }).then(response => {
            return response.status;
        }).then(data => {
            if (data == 200) {
                // Restaurer l'image en cas d'échec
                heart.setAttribute('src', newSrc);
            }
        }).catch(error => {
            console.error('Erreur:', error);
        });
    }

    const favoriteExercises= document.querySelectorAll('.favoriteExercise');
    if (favoriteExercises) {
    for (let exercise of favoriteExercises) {
        const heart = exercise.querySelector('.heart');
        const exerciseId = heart.id;
        console.log(exerciseId);
        heart.addEventListener('click',() => toggleFavorite(exerciseId, heart))
    }
}
