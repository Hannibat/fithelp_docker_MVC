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
                <label for="containt" class="form-label"><span class="text-danger">*</span>Paragraphe</label>
                <textarea class="form-control" id="containt" name="containt" required></textarea>
                <div class="form-text text-danger fs-5 text"><?= $error['containt'] ?? '' ?></div>
            </div>
            <div class="col-12 mb-1">
                <label for="conclusion" class="form-label"><span class="text-danger">*</span>Conclusion</label>
                <textarea class="form-control" id="conclusion" name="conclusion" required></textarea>
                <div class="form-text text-danger fs-5 text"><?= $error['conclusion'] ?? '' ?></div>
            </div>
            <div class="col-4 mb-3">
                <label for="category_article_id" class="form-label"><span class="text-danger">*</span>Catégorie d'articles</label>
                <select class="form-control" id="category_article_id" name="category_article_id" required>
                    <option value="">Sélectionner une catégorie d'articles</option>
                    <?php foreach ($categories_article as $category_article) : ?>
                        <option value="<?= htmlspecialchars($category_article->category_article_id) ?>"><?= htmlspecialchars($category_article->category_name) ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="form-text text-danger fs-5 text"><?= $error['category_article_id'] ?? '' ?></div>
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