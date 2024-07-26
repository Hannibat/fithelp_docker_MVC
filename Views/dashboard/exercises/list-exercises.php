<?php ob_start(); ?>
<div class="container">
    <h1><?= $title ?></h1>
    <div class="row">
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
                        <form method="GET" class="row justify-content-around px-1">
                            <div class="col-8 d-flex justify-content-center">
                                <input type="hidden" name="exercise_id" value="<?= htmlspecialchars($exercise->exercise_id) ?>">
                                <input type="hidden" name="page" value="exercises/update-exercise">
                                <button type="submit" class="btn btn-warning mt-1 w-100">Modifier</button>
                            </div>
                        </form>
                        <form action="" method="POST" class="row justify-content-around px-1">
                            <div class="col-8 d-flex justify-content-center">
                                <input type="hidden" name="exercise_id" value="<?= htmlspecialchars($exercise->exercise_id) ?>">
                                <button type="submit" name="delete" class="btn btn-danger mt-1 w-100">Supprimer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php $main = ob_get_clean(); ?>