<?php ob_start(); ?>
<div class="container">
    <h1><?= $title ?></h1>

    <?php if (isset($_SESSION['flash_message'])) : ?>
        <div class="text-success fs-7 my-1">
            <?= $_SESSION['flash_message'] ?>
        </div>
        <?php unset($_SESSION['flash_message']); ?>
    <?php endif; ?>

    <!-- Affichage des messages de succès ou d'erreur pour la suppression -->
    <div class="row">
        
    <?php if (isset($_SESSION['flash_message'])) : ?>
        <div class="text-success fs-7 my-1">
            <?= $_SESSION['flash_message'] ?>
        </div>
        <?php unset($_SESSION['flash_message']);
        ?>
    <?php endif; ?>


        <!-- Sélection de catégorie d'articles -->
        <div class="container">
    <div class="row justify-content-between align-items-center">
        <!-- Formulaire de sélection de catégorie -->
        <div class="col-md-4 my-2">
            <form action="" method="GET">
                <select class="form-control" name="category_article_id" id="category_article_id">
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach ($categories_articles as $category_article) : ?>
                        <option value="<?= htmlspecialchars($category_article->category_article_id) ?>">
                            <?= htmlspecialchars($category_article->category_name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <?php if ($user->role == 1) : ?>
        <!-- Bouton d'ajout d'article -->
        <div class="col-md-4 text-end">
            <div class="my-3">
                <a href="http://localhost:8001/?page=articles/add-article" class="btn btn-add">
                    Ajouter un article <i class="fas fa-plus ms-2"></i>
                </a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>


    <div class="row">
        <?php foreach ($articles as $article) : ?>
            <div class="col-md-4 mb-4">
                <a href="?page=users/detail-article&article_id=<?= $article->article_id ?>">
                    <div class="card" style="width: 100%;">
                        <!-- Image de l'article -->
                        <?php if ($article->picture) : ?>
                            <img src="public/uploads/articles/<?= $article->picture ?>" class="card-img-top" alt="<?= $article->title ?>">
                        <?php endif; ?>
                </a>

                <!-- Contenu de la carte -->
                <div class="card-body">
                    <h5 class="card-title"><?= $article->title ?></h5>
                    <p class="card-text text-intro-card"><?= htmlspecialchars_decode($article->intro) ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Catégorie de l'article -->
                        <div class="btn btn-primary">
                            <?= $article->category_name ?>
                        </div>

                        <!-- Actions selon le rôle de l'utilisateur -->
                        <div class="d-flex">
                        <?php if ($user) : ?>
                            <?php if ($user->role == 1) : ?>
                                <form action="?page=articles/delete-article" method="POST" class="d-inline me-2">
                                <input type="hidden" name="page" value="articles/delete-article">
                                    <input type="hidden" name="article_id" value="<?= $article->article_id ?>">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php endforeach; ?>
</div>
<?php $main = ob_get_clean(); ?>