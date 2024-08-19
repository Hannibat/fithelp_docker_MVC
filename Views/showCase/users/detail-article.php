<?php ob_start(); ?>
<div class="container text-center">
    <h1><?= htmlspecialchars($article->title) ?></h1>

    <!-- Introduction -->
    <div class="intro mb-4">
        <p><?= nl2br(htmlspecialchars($article->intro)) ?></p>
    </div>

    <?php if ($article->picture) : ?>
        <img src="<?= UPLOAD_DIR . '/articles/' . htmlspecialchars($article->picture) ?>" alt="<?= htmlspecialchars($article->title) ?>" class="img-fluid mb-4">
    <?php endif; ?>

    <!-- Contenu principal de l'article -->
    <div class="content mb-4">
        <p><?= nl2br(htmlspecialchars($article->containt)) ?></p>
    </div>

    <!-- Conclusion de l'article -->
    <div class="conclusion">
        <p><?= nl2br(htmlspecialchars($article->conclusion)) ?></p>
    </div>
    <div>
        <?= 'Article publié le ' . (new DateTime($article->publication_date))->format('d/m/Y') ?>
    </div>
    <!-- Actions pour les administrateurs ou rédacteurs -->
    <?php if ($user->role == 1) : ?>
        <div class="d-flex justify-content-between mt-4">
            <a href="?page=articles/update-article&article_id=<?= htmlspecialchars($article->article_id) ?>" class="btn btn-warning">Modifier</a>
            <form action="?page=articles/delete-article" method="POST">
                <input type="hidden" name="article_id" value="<?= htmlspecialchars($article->article_id) ?>">
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-trash"></i> Supprimer
                </button>
            </form>
        </div>
    <?php endif; ?>
</div>
<?php $main = ob_get_clean(); ?>