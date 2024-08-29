<?php ob_start(); ?>
<div class="container">
    <h1 class="mt-3"><?= $title ?></h1>
    <div id="nameHelp" class="form-text text-danger fs-5"><?= $error['delete'] ?? '' ?></div>
    <div id="nameHelp" class="form-text text-success fs-5"><?= $success['delete'] ?? '' ?></div>
    <div id="nameHelp" class="form-text text-danger fs-5"><?= $error['update'] ?? '' ?></div>
    <div id="nameHelp" class="form-text text-success fs-5"><?= $success['update'] ?? '' ?></div>
    <a href="?page=categories-article/add-category-article" class="call-action text-white btn bg-blueElec my-3">+ Créer une nouvelle catégorie</a>
    <div class="">
    <table class="table-responsive">
        <thead>
            <tr>
                <th scope="col">Identifiant</th>
                <th scope="col">Nom de la catégorie</th>
                <th scope="col">Modifier</th>
                <th scope="col">Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories_article as $category_article) : ?>
                <tr>
                    <th scope="row"><?= $category_article->category_article_id ?></th>
                    <td>
                    <form class="update-form" action="?page=categories-article/update-category-article" method="POST">
                        <input type="hidden" name="category_article_id" value="<?= htmlspecialchars($category_article->category_article_id); ?>">
                        <input type="text" name="name" value="<?= htmlspecialchars($category_article->category_name); ?>">
                        <td>
                            <button type="submit" name="update" class="btn btn-primary">Mettre à jour</button>
                        </td>
                    </form>
                    <form class="delete-form" action="?page=categories-article/delete-category-article" method="POST">
                        <input type="hidden" name="category_article_id" value="<?= htmlspecialchars($category_article->category_article_id); ?>">
                        <td>
                            <button type="submit" name="delete" class="btn btn-danger">Supprimer</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>
</div>
<?php $main = ob_get_clean(); ?>
