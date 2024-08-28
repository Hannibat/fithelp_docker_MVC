<?php ob_start(); ?>
<div class="container">

    <h1 class="my-2"><?= $title ?></h1>

    <?php if (isset($_SESSION['flash_message'])) : ?>
        <div class="text-success fs-7 my-1">
            <?= $_SESSION['flash_message'] ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <div class="row my-3">
        <div class="col-md-4 text-md-start">
            <form action="" method="GET" id="categoryFilterForm">
                <input type="hidden" value="exercises/list-exercises" name="page">
                <select class="form-select" name="body_part_id" id="body_part_id" aria-label="Sélectionner une partie du corps" required>
                    <option value="" disabled selected>Sélectionner une partie du corps</option>
                    <?php foreach ($body_parts as $body_part) : ?>
                        <option value="<?= $body_part->body_part_id ?>" <?= isset($_GET['body_part_id']) && $_GET['body_part_id'] == $body_part->body_part_id ? 'selected' : '' ?>>
                            <?= $body_part->body_part ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <div class="col-md-4 my-md-0 my-2">
            <form id="search-form" class="form-inline" method="GET">
                <div class="input-group w-100">
                    <input type="hidden" value="exercises/list-exercises" name="page">

                    <input type="text" class="form-control" name="search" placeholder="Rechercher un exercice">
                    <button type="submit" class="btn btn-primary input-group-text">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>

        <?php if ($user->role == 1) : ?>
            <div class="col-md-4 text-md-end">
                <a href="http://localhost:8001/?page=exercises/add-exercise" class="exercise-title btn btn-add">
                    Ajouter un exercice<i class="fas fa-plus ms-2"></i>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <div id="display" class="row">
        <?php foreach ($exercises as $exercise) : ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card mb-4">
                    <a href="?page=users/detail-exercise&exercise_id=<?= $exercise->exercise_id ?>">
                        <?php if ($exercise->image) : ?>
                            <div class="card-img-container">
                                <img src="public/uploads/exercises/<?= htmlspecialchars($exercise->image) ?>" class="card-img-top img-fluid" alt="<?= htmlspecialchars($exercise->title) ?>">
                            </div>
                        <?php endif; ?>
                    </a>
                    <div class="card-body pb-0">
                        <h5 class="card-title title" title="<?= htmlspecialchars($exercise->title) ?>">
                            <?= htmlspecialchars($exercise->title) ?>
                        </h5>
                        <h6 class="card-subtitle text-muted"><?= htmlspecialchars($exercise->body_part) ?></h6>
                        <div class="row justify-content-between data-fetch-js py-1">
                            <!-- Formulaire de suppression d'exercice -->
                            <?php if ($user->role == 1) : ?>
                                <div class="col">
                                    <form action="?page=exercises/delete-exercise" method="POST" class="d-inline">
                                        <input type="hidden" name="page" value="exercises/delete-exercise">
                                        <input class="exercise_id" type="hidden" name="exercise_id" value="<?= htmlspecialchars($exercise->exercise_id) ?>">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-exercise-id="<?= htmlspecialchars($exercise->exercise_id) ?>">
                                        <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <!-- Icône de favori -->
                            <div class="col-auto ms-auto">
                                <img
                                    id="favoriteIcon"
                                    class="heart"
                                    src="/public/assets/img/<?= $exercise->is_favorite ? "heart" : "heart_empty"?>.png"
                                    alt="Coeur vide">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmation de suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Êtes-vous sûr de vouloir supprimer cet exercice ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Supprimer</button>
            </div>
        </div>
    </div>
</div>

<?php $main = ob_get_clean(); ?>