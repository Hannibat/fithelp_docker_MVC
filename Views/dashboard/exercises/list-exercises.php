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
            <form id="search-form" class="form-inline" method="$_GET">
                <div class="input-group w-100">
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
                                <img src="public/uploads/exercises/<?= $exercise->image ?>" class="card-img-top img-fluid" alt="<?= $exercise->title ?>">
                            </div>
                        <?php endif; ?>
                    </a>
                    <div class="card-body">
                        <h5 class="card-title title" title="<?= $exercise->title ?>"><?= $exercise->title ?></h5>
                        <h6 class="card-subtitle text-muted"><?= $exercise->body_part ?></h6>
                        <?php if ($user->role == 1) : ?>
                            <form action="?page=exercises/delete-exercise" class="row justify-content-end px-1" method="POST">
                                <div class="col-7 d-flex justify-content-end px-1">
                                    <input type="hidden" name="page" value="exercises/delete-exercise">
                                    <input type="hidden" name="exercise_id" value="<?= $exercise->exercise_id ?>">
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