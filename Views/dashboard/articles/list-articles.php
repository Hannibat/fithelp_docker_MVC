<?php ob_start(); ?>
<div class="container">
    <h1><?= htmlspecialchars($title) ?></h1>

    <!-- Affichage des messages de succès ou d'erreur pour la suppression -->
    <div class="row">
        <?php if (isset($success['delete'])) : ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($success['delete'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error['delete'])) : ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error['delete'], ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- Sélection de catégorie d'articles -->
        <div class="col-md-4 mb-3">
            <form action="" method="GET">
                <label for="category_article">Catégorie d'article</label>
                <select class="form-control" name="category_article_id" id="category_article">
                    <option value="">Sélectionner une catégorie</option>
                    <?php foreach ($categories_articles as $category_article) : ?>
                        <option value="<?= htmlspecialchars($category_article->category_article_id) ?>">
                            <?= htmlspecialchars($category_article->category_name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
        </div>
        </form>
    </div>

    <div class="row">
        <?php foreach ($articles as $article) : ?>
            <div class="col-md-4 mb-4">
                <a href="?page=users/detail-article&article_id=<?= htmlspecialchars($article->article_id) ?>">
                    <div class="card" style="width: 100%;">
                        <!-- Image de l'article -->
                        <?php if ($article->picture) : ?>
                            <img src="public/uploads/articles/<?= htmlspecialchars($article->picture) ?>" class="card-img-top" alt="<?= htmlspecialchars($article->title) ?>">
                        <?php endif; ?>
                </a>

                <!-- Contenu de la carte -->
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($article->title) ?></h5>
                    <p class="card-text text-intro-card"><?= htmlspecialchars_decode($article->intro) ?></p>
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Catégorie de l'article -->
                        <div class="btn btn-primary">
                            <?= htmlspecialchars($article->category_name) ?>
                        </div>

                        <!-- Actions selon le rôle de l'utilisateur -->
                        <div class="d-flex">
                            <?php if ($user->role == 1) : ?>
                                <form action="?page=articles/delete-article" method="POST" class="d-inline me-2">
                                    <input type="hidden" name="article_id" value="<?= htmlspecialchars($article->article_id) ?>">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-trash"></i> <!-- Icône de corbeille -->
                                    </button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php endforeach; ?>
</div>
<?php $main = ob_get_clean(); ?>