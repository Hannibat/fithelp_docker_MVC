<?php ob_start(); ?>
<div class="container">
    <h3 class="my-3"><?= $title ?></h3>
    <div id="nameHelp" class="form-text text-danger fs-5 text"><?= $error['name'] ?? '' ?></div>
    <div id="nameHelp" class="form-text text-danger fs-5 text"><?= $error['file'] ?? '' ?></div>
    <div id="nameHelp" class="form-text text-success fs-5 text"><?= $success['file'] ?? '' ?></div>

    <div>
        <form class="add-exercise row" method="POST" enctype="multipart/form-data">
            <span class="text-danger m-1">Le champ * est obligatoire</span>
            <div class="col-6 mb-1">
                <label for="title" class="form-label"><span class="text-danger">*</span>Titre</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <div class="form-text text-danger fs-5 text"><?= $error['title'] ?? '' ?></div>
            </div>
            <div class="col-12 mb-1">
                <label for="intro" class="form-label"><span class="text-danger">*</span>Introduction</label>
                <textarea class="form-control" id="intro" name="intro" required></textarea>
                <div class="form-text text-danger fs-5 text"><?= $error['intro'] ?? '' ?></div>
            </div>
                <div class="col-12 mb-1">
                    <label for="position" class="form-label"><span class="text-danger">*</span>Position</label>
                    <textarea class="form-control" id="position" name="position" required></textarea>
                    <div class="form-text text-danger fs-5 text"><?= $error['position'] ?? '' ?></div>
                </div>
                <div class="col-12 mb-1">
                    <label for="movement" class="form-label"><span class="text-danger">*</span>Mouvement</label>
                    <textarea class="form-control" id="movement" name="movement" required></textarea>
                    <div class="form-text text-danger fs-5 text"><?= $error['movement'] ?? '' ?></div>
                </div>
                <div class="col-12 mb-1">
                    <label for="targeted_muscles" class="form-label"><span class="text-danger">*</span>Muscles ciblés</label>
                    <textarea class="form-control" id="targeted_muscles" name="targeted_muscles" required></textarea>
                    <div class="form-text text-danger fs-5 text"><?= $error['targeted_muscles'] ?? '' ?></div>
                </div>
                <div class="col-6 mb-3">
                    <label for="body_part_id" class="form-label"><span class="text-danger">*</span>Partie du corps</label>
                    <select class="form-control" id="body_part_id" name="body_part_id" required>
                        <option value="">Sélectionner une partie du corps</option>
                        <?php foreach ($body_parts as $body_part) : ?>
                            <option value="<?=  htmlspecialchars($body_part->body_part_id) ?>"><?=  htmlspecialchars($body_part->body_part) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="form-text text-danger fs-5 text"><?= $error['body_part_id'] ?? '' ?></div>
                </div>
                <div class="col-12 mb-3">
                    <label for="formFile" class="form-label"><span class="text-danger">*</span>Ajouter une image</label>
                    <input class="form-control" type="file" id="formFile" name="file">
                    <!-- <legend class="fs-6"></legend> -->
                </div>
            <button type="submit" class="btn btn-primary m-3 col-2 align-content-center">Ajouter</button>
        </form>
    </div>
</div>
<?php $main = ob_get_clean(); ?>