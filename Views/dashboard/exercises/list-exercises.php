<?php ob_start(); ?>
<div class="container">

    <h1><?= $title ?></h1>
    <div class="row">
        <?php if (isset($success['delete'])) : ?>
            <div class="alert alert-success"><?= htmlspecialchars($success['delete'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <?php if (isset($error['delete'])) : ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error['delete'], ENT_QUOTES, 'UTF-8') ?></div>
        <?php endif; ?>
        <div class="col-md-4">
            <div class="mb-3">
                <form action="">
                    <div class="form-floating">
                        <select class="form-control" name="body_part_id" id="body_part">
                            <option value=""></option>
                            <?php foreach ($body_parts as $body_part) : ?>
                                <option value="<?= $body_part->body_part_id ?>"><?= $body_part->body_part ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="display" class="row">
        <?php foreach ($exercises as $exercise) : ?>
            <div class="col-md-3">
                <div class="card mb-3">
                    <?php if ($exercise->image) : ?>
                        <img src="public/uploads/exercises/<?= $exercise->image ?>" class="d-block user-select-none" width="100%" alt="<?= $exercise->title ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title"><?= $exercise->title ?></h5>
                        <h6 class="card-subtitle text-muted"><?= $exercise->body_part ?></h6>
                        <?php if ($user->role == 1) : ?>
                            <form class="delete-exercise" action="" method="GET" class="row justify-content-around px-1">
                                <div class="col-7 d-flex justify-content-center px-1">
                                    <a class="btn btn-warning w-100" href="?page=exercises/update-exercise&exercise_id=<?= htmlspecialchars($exercise->exercise_id) ?>">Modifier</a>
                                </div>
                            </form>
                            <form action="" class="row justify-content-around px-1" method="GET">
                                <div class="col-7 d-flex justify-content-center px-1">
                                    <input type="hidden" name="page" value="exercises/delete-exercise">
                                    <input type="hidden" name="exercise_id" value="<?= htmlspecialchars($exercise->exercise_id) ?>">
                                    <button type="submit" class="btn btn-danger mt-1 w-100">Supprimer</button>
                                </div>
                            </form>
                        <?php else : ?>
                            <div class="row justify-content-around px-1">
                                <div class="col-7 d-flex justify-content-center px-1">
                                    <a class="btn btn-info w-75 mt-2" href="?page=exercises/view-exercise&exercise_id=<?= htmlspecialchars($exercise->exercise_id) ?>">Aperçu</a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php $main = ob_get_clean(); ?>