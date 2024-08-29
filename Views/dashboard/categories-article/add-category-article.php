<?php ob_start(); ?>

<div class="container">
        <h3 class="my-3"><?= $title ?></h3>
    
        <form method="POST">
            <div class="col-6 my-3">
                <label for="name" class="form-label">Ajout d'une catégorie</label>
                <input type="text" class="form-control" id="name" name="name" aria-describedby="Categorie">
            </div>
            <button type="submit" class="btn btn-primary my-3">Ajouter</button>
        </form>
        <div id="nameHelp" class="form-text text-danger fs-5 text"><?= $error['name'] ?? '' ?></div>
    </div>
</div>
<?php $main = ob_get_clean(); ?>