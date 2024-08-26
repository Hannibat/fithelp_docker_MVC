<?php ob_start(); ?>
<div class="container my-4">
    <!-- Exercice -->
    <article class="exercise-content mx-auto" style="max-width: 800px;">
        <!-- Titre de l'exercice -->
        <header class="exercise-header">
            <h1 class="exercise-title fs-3 text-center"><?= $exercise->title ?></h1>
        </header>

        <!-- Introduction de l'exercice -->
        <section class="exercise-intro my-4">
            <h6>Introduction</h6>
            <p class="unicode"><?= $exercise->intro ?></p>
        </section>

        <!-- Position de l'exercice -->
        <section class="exercise-body mb-4">
            <h6>La position</h6>
            <p class="unicode"><?= $exercise->position ?></p>
        </section>

        <!-- Image et Mouvement de l'exercice -->
        <section class="exercise-image-movement row align-items-center justify-content-between mb-4">
            <!-- Image de l'exercice (si disponible)-->
            <?php if ($exercise->image) : ?>
                <div class="col-12 col-md-6 mb-3 mb-md-0 d-flex justify-content-center">
                    <figure class="w-100">
                        <img src="<?= UPLOAD_DIR . '/exercises/' . $exercise->image ?>" alt="<?= $exercise->title ?>" class="img-fluid">
                        <figcaption class="text-muted figImage"><?= $exercise->title ?> - Crédit illustration ©Makatserchyk</figcaption>
                    </figure>
                </div>
                <?php endif; ?>

            <!-- Mouvement de l'exercice -->
            <div class="col-12 col-md-6">
                <h6>Le mouvement</h6>
                <p class="unicode"><?= $exercise->movement ?></p>
            </div>
        </section>

        <!-- Muscles ciblés de l'exercice -->
        <section class="exercise-conclusion">
            <h6>Les muscles ciblés</h6>
            <p class="unicode"><?= htmlspecialchars_decode($exercise->targeted_muscles) ?></p>
        </section>
    </article>

    <!-- Actions pour les administrateurs ou rédacteurs -->
    <?php if ($user->role == 1) : ?>
        <div class="d-flex justify-content-around my-4">
            <a href="?page=exercises/update-exercise&exercise_id=<?= $exercise->exercise_id ?>" class="btn btn-info">Modifier</a>
            <form action="?page=exercises/delete-exercise" class="row justify-content-end px-1" method="POST">
                <div class="col-7 d-flex justify-content-end px-1">
                    <input type="hidden" name="page" value="exercises/delete-exercise">
                    <input type="hidden" name="exercise_id" value="<?= $exercise->exercise_id ?>">
                    <button type="submit" class="btn btn-danger mt-1 d-flex justify-content-around">
                        Supprimer
                    </button>
                </div>
            </form>
        </div>
    <?php endif; ?>


</div>

<?php $main = ob_get_clean(); ?>