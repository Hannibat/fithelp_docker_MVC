<?php ob_start(); ?>
<div class="container article-container my-4">
    <!-- Article -->
    <article class="article-content">
        <!-- Titre de l'article -->
        <header class="article-header">
            <h1 class="article-title fs-3"><?= $article->title ?></h1>
        </header>

        <!-- Introduction de l'article -->
        <section class="article-intro my-4">
            <p class="unicode"><?= $article->intro ?></p>
        </section>

        <!-- Image de l'article (si disponible) -->
        <?php if ($article->picture) : ?>
            <figure class="article-image">
                <img src="<?= UPLOAD_DIR . '/articles/' . $article->picture ?>" alt="<?= $article->title ?>" class="img-fluid mb-1">
                <figcaption><?= $article->title ?></figcaption>
            </figure>
        <?php endif; ?>

        <!-- Contenu principal de l'article -->
        <section class="article-body mb-4">
            <p class="unicode"><?=  $article->containt ?></p>
        </section>

        <!-- Conclusion de l'article -->
        <section class="article-conclusion">
            <p class="unicode"><?= $article->conclusion ?></p>
        </section>

        <!-- Publication date -->
        <footer class="article-footer">
            <small><?= 'Article publié le ' . (new DateTime($article->publication_date))->format('d/m/Y') ?></small>
        </footer>
    </article>
    <!-- Actions pour les administrateurs ou rédacteurs -->
    <?php if ($user->role == 1) : ?>
        <div class="d-flex justify-content-around mt-4">
            <a href="?page=articles/update-article&article_id=<?= $article->article_id ?>" class="btn btn-warning">Modifier</a>
            <form action="?page=articles/delete-article" method="POST">
                <input type="hidden" name="article_id" value="<?= $article->article_id ?>">
                <button type="submit" class="btn btn-danger">
                    Supprimer
                </button>
            </form>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php $main = ob_get_clean(); ?>