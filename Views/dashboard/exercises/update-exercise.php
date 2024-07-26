<?php ob_start(); ?>
<div class="container">
    <h1 class="text-center my-3"><?= $title ?></h1>
    <div class="row justify-content-center">
        <div class="col-md-5 shadow p-3">
            <form method="POST" action="" enctype="multipart/form-data">
            <div class="mb-3">
                    <label for="brand" class="form-label mt-4">Partie du corps</label>
                    <select name="body_part" id="body_part">
                        <option disabled selected>-- Selectionner une partie du corps --</option>
                        <?php foreach($body_parts as $body_part) : ?>
                            <option <?= $body_part == $body_part->body_part ? 'selected' : '' ?>><?= $body_part ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            <?php foreach ($vehicles as $vehicle) : ?>
                <div>
                    <div class="id-vehicle" scope="row"><?= $vehicle->vehicle_id ?>
                </div>
                    <div>
                        <form class="update-vehicle-form" action="" medivod="POST">
                            <input type="hidden" name="vehicle_id" value="<?php echo $vehicle->vehicle_id; ?>">
                            <input class="brand" type="text" name="brand" value="<?php echo htmlspecialchars($vehicle->brand); ?>">
                    <div>
                        <input class="model" type="text" name="model" value="<?php echo htmlspecialchars($vehicle->model); ?>">
                    </div>
                    <div>
                        <input class="regidivation" type="text" name="regidivation" value="<?php echo htmlspecialchars($vehicle->registration); ?>">
                    </div>
                    <div>
                        <input class="mileage" type="text" name="mileage" value="<?php echo htmlspecialchars($vehicle->mileage); ?>">
                    </div>
                    <div>
                        <select class="form-select custom-select-size" name="category" id="">
                            <?php foreach ($categories as $category) : ?>
                                <option value="<?= $category->category_id ?>" <?= $category->category_id === $vehicle->category_id ? 'selected' : '' ?>><?= $category->name ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                            </div>
                </div>
                <div>
                    <button type="submit" name="update" class="btn btn-primary">Modifier</button>
                </div>
                <div>
                    <input type="hidden" name="vehicle_id" value="<?= htmlspecialchars($vehicle->vehicle_id); ?>">
                    <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                </div>
                <button type="submit" class="btn btn-primary">Enregister</button>
            </form>
        </div>
    </div>
</div>
<?php endforeach ?>
<?php $main = ob_get_clean(); ?>