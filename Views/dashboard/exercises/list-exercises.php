<?php ob_start(); ?>
<div class="container">

    <h1><?= $title ?></h1>

    <!-- Affichage du message flash -->
    <?php if (isset($_SESSION['flash_message'])) : ?>
        <div class="text-success fs-7 my-1">
            <?= $_SESSION['flash_message'] ?>
        </div>
        <?php unset($_SESSION['flash_message']); // Efface le message après affichage 
        ?>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <form action="" method="GET" class="mb-3">
                    <select class="form-select" name="body_part_id" id="body_part" aria-label="Sélectionner une partie du corps" required>
                        <option value="" disabled selected>Sélectionner une partie du corps</option>
                        <?php foreach ($body_parts as $body_part) : ?>
                            <option value="<?= htmlspecialchars($body_part->body_part_id) ?>">
                                <?= htmlspecialchars($body_part->body_part) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                </form>
            </div>
        </div>
    </div>
    <div id="display" class="row">
        <?php foreach ($exercises as $exercise) : ?>
            <div class="col-md-3">
                <div class="card mb-3">
                    <a href="?page=users/detail-exercise&exercise_id=<?= htmlspecialchars($exercise->exercise_id) ?>">
                        <?php if ($exercise->image) : ?>
                            <img src="public/uploads/exercises/<?= $exercise->image ?>" class="d-block user-select-none" width="100%" alt="<?= $exercise->title ?>">
                        <?php endif; ?>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title"><?= $exercise->title ?></h5>
                        <h6 class="card-subtitle text-muted"><?= $exercise->body_part ?></h6>
                        <?php if ($user->role == 1) : ?>
                            <form action="?page=exercises/delete-exercise" class="row justify-content-end px-1" method="POST">
                                <div class="col-7 d-flex justify-content-end px-1">
                                    <input type="hidden" name="page" value="exercises/delete-exercise">
                                    <input type="hidden" name="exercise_id" value="<?= htmlspecialchars($exercise->exercise_id) ?>">
                                    <button type="submit" class="btn btn-danger mt-1 d-flex justify-content-around">
                                        <span></span>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </div>
                            </form>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php $main = ob_get_clean(); ?>