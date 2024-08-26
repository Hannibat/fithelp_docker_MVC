<?php ob_start(); ?>

<a href="/?page=exercises/list-exercises" class="mx-5">Retour</a>
<div class="container my-3">
    <h1 class="text-center my-3"><?= $title ?></h1>
    <div class="row justify-content-center">
        <div class="col-md-10 shadow p-4 rounded">
            <form id="update-exercise-form" action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="exercise_id" value="<?= htmlspecialchars($exercise->exercise_id); ?>">

                <div class="mb-3">
                    <label for="title" class="form-label exercise-title">Titre</label>
                    <input id="title" class="form-control" type="text" name="title" value="<?= htmlspecialchars($exercise->title, ENT_QUOTES, 'UTF-8'); ?>">
                    <small class="text-danger"><?= $_SESSION['error']['title'] ?? ''; ?></small>
                </div>

                <div class="mb-3">
                    <label for="intro" class="form-label exercise-title">Introduction</label>
                    <div id="intro" class="form-control" contenteditable="true"><?= htmlspecialchars_decode($exercise->intro, ENT_QUOTES); ?></div>
                    <input type="hidden" id="intro-hidden" name="intro-hidden" value="<?= htmlspecialchars($exercise->intro, ENT_QUOTES, 'UTF-8'); ?>">
                    <small class="text-danger"><?= $_SESSION['error']['intro'] ?? ''; ?></small>
                </div>

                <div class="mb-3">
                    <label for="position" class="form-label exercise-title">Position</label>
                    <div id="position" class="form-control" contenteditable="true"><?= htmlspecialchars_decode($exercise->position, ENT_QUOTES); ?></div>
                    <input type="hidden" id="position-hidden" name="position-hidden" value="<?= htmlspecialchars($exercise->position, ENT_QUOTES, 'UTF-8'); ?>">
                    <small class="text-danger"><?= $_SESSION['error']['position'] ?? ''; ?></small>
                </div>

                <div class="mb-3">
                    <label for="movement" class="form-label exercise-title">Mouvement</label>
                    <div id="movement" class="form-control" contenteditable="true"><?= htmlspecialchars_decode($exercise->movement, ENT_QUOTES); ?></div>
                    <input type="hidden" id="movement-hidden" name="movement-hidden" value="<?= htmlspecialchars($exercise->movement, ENT_QUOTES, 'UTF-8'); ?>">
                    <small class="text-danger"><?= $_SESSION['error']['movement'] ?? ''; ?></small>
                </div>

                <div class="mb-3">
                    <label for="targeted_muscles" class="form-label exercise-title">Muscles ciblés</label>
                    <div id="targeted_muscles" class="form-control" contenteditable="true"><?= htmlspecialchars_decode($exercise->targeted_muscles, ENT_QUOTES); ?></div>
                    <input type="hidden" id="targeted_muscles-hidden" name="targeted_muscles-hidden" value="<?= htmlspecialchars($exercise->targeted_muscles, ENT_QUOTES, 'UTF-8'); ?>">
                    <small class="text-danger"><?= $_SESSION['error']['targeted_muscles'] ?? ''; ?></small>
                </div>

                <div class="mb-3">
                    <label for="body_part" class="form-label exercise-title">Partie du corps</label>
                    <select id="body_part" class="form-select custom-select-size" name="body_part" required>
                        <?php foreach ($body_parts as $body_part) : ?>
                            <option value="<?= htmlspecialchars($body_part->body_part_id, ENT_QUOTES, 'UTF-8') ?>" <?= $body_part->body_part_id == $exercise->body_part_id ? 'selected' : '' ?>>
                                <?= htmlspecialchars($body_part->body_part, ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-danger"><?= $_SESSION['error']['body_part'] ?? ''; ?></small>
                </div>

                <div id="img-exercise-update" class="py-2 hide-show-picture exercise-title">
                    <p>Image actuelle :</p>
                    <img class="img-fluid w-50" src="<?= '/public/uploads/exercises/' . ($exercise->image ?? ''); ?>" alt="<?= $exercise->title ?>" />
                    <div class="col-12 my-3">
                        <label for="formFile" class="form-label exercise-title">Remplacer l'image</label>
                        <input class="form-control" type="file" id="formFile" name="file">
                        <small class="text-danger"><?= $_SESSION['error']['file'] ?? ''; ?></small>
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" name="update" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $main = ob_get_clean(); ?>