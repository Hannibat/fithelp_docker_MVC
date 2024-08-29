<?php ob_start(); ?>

<section id="hero" class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex flex-column justify-content-center bg-hero-image p-0">
            <div class="blur container p-0 ">
                <div class="row">
                    <div class="col-8-md d-flex">
                        <p class="text-white ms-3">
                            SITE DE MUSCULATION & CONSEILS
                        </p>
                    </div>
                    <div class="col-11 d-flex justify-content-end mb-2 me-5">
                    <a href="?page=exercises/list-exercises" class="btn btn-action">LES EXERCICES</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-evenly mt-4 mb-4">
            <div class="card col-6 m-2" style="width: 18rem;">
                <img class="card-img-top mt-2" src="/public/assets/img/fitness-room.jpg" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title">EXERCICES <br> MUSCULATION</h5>
                    <p class="card-text">L’exécution des exercices est importante pour la progression et éviter les blessures.</p>
                    <a href="?page=exercises/list-exercises" class="btn btn-action">VOIR LES EXERCICES</a>
                </div>
            </div>
            <div class="card col-6 m-2" style="width: 18rem;">
                <img class="card-img-top mt-2" src="/public/assets/img/man-ex.jpg" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title">PROGRAMMES MUSCULATION</h5>
                    <p class="card-text">Programmes de musculation adaptés à tes besoins et à ton objectif sur plusieurs semaines.<br /></p>
                    <a href="#" class="btn btn-action">VOIR LES PROGRAMMES</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="presentation" class="container-fluid mb-3">
    <div class="row justify-content-center">
        <!-- Image de présentation -->
        <div class="col-12 col-md-3 d-flex justify-content-center align-items-center mt-3">
            <img src="/public/assets/img/flomuscu.webp" alt="photo du coach en plein exercice" class="img-fluid pb-3">
        </div>
        
        <!-- Texte de présentation -->
        <div class="col-12 col-md-7 mt-3">
            <div class="row">
                <div class="col-12 mb-3">
                    <h3 class="text-center text-md-start text-white">PRÉSENTATION</h3>
                </div>
                <div id="text-presentation" class="col-12 text-white mb-1">
                    <span>
                        Je m’appelle Florent et je suis là pour vous aider. Depuis 20 ans maintenant, je suis un passionné de musculation, un mode de vie qui a façonné non seulement mon physique, mais aussi mon esprit et ma discipline. J’ai créé ce site pour vous améliorer sur les exercices, à avoir une meilleure posture et à éviter les blessures.
                        Que vous soyez débutant ou avancé, vous trouverez ici des conseils adaptés à votre niveau. Ensemble, nous allons atteindre vos objectifs et maximiser vos performances tout en prenant soin de votre santé.
                    </span>
                </div>
                <div class="col-12 d-flex justify-content-end my-3">
                    <a href="?page=showCase/presentation" class="me-3 text-white">Lire la suite...</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-3">
<h2 class="color-blueElec mb-4">Derniers Articles</h2>
    <div class="row">
        <?php foreach ($articles as $article) : ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="width: 100%;">
                    <a href="?page=users/detail-article&article_id=<?= $article->article_id?>">
                        <!-- Image de l'article -->
                        <?php if ($article->picture) : ?>
                            <img src="public/uploads/articles/<?= $article->picture ?>" class="card-img-top" alt="<?= $article->title ?>">
                        <?php endif; ?>
                    </a>

                    <!-- Contenu de la carte -->
                    <div class="card-body">
                        <h5 class="card-title"><?= $article->title ?></h5>
                        <p class="card-text text-intro-card"><?= $article->intro ?></p>
                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Catégorie de l'article -->
                            <div class="btn btn-primary">
                                <?= $article->category_name ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Bouton pour plus d'articles -->
    <div class="row justify-content-center mt-3">
        <div class="col-auto">
            <a href="?page=articles/list-articles" class="btn btn-action">
                Plus d'articles
            </a>
        </div>
    </div>
</div>


<?php $main = ob_get_clean(); ?>