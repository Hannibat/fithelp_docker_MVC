<?php ob_start(); ?>

<section id="hero" class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex flex-column justify-content-center bg-hero-image">
            <div class="container p-0">
                <div class="row">
                    <!-- Slogan -->
                    <div class="col-12 d-flex  p-0">
                        <p class="text-white ms-5">
                            SITE DE MUSCULATION & CONSEILS
                        </p>
                    </div>
                    <!-- Button call to action -->
                    <div class="col-11 d-flex justify-content-end mb-2 me-5">
                        <button class="btn btn-action">LES EXERCICES</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container-fluid">
    <div class="container">
        <div class="row justify-content-around mt-4 mb-4">
            <div class="card col-6" style="width: 18rem;">
                <img class="card-img-top mt-2" src="/public/assets/img/fitness-room.jpg" alt="Card image cap">
                <div class="card-body text-center">
                    <h5 class="card-title">EXERCICES <br> MUSCULATION</h5>
                    <p class="card-text">L’exécution des exercices est importante pour la progression et éviter les blessures.</p>
                    <a href="#" class="btn btn-action">VOIR LES EXERCICES</a>
                </div>
            </div>
            <div class="card col-6" style="width: 18rem;">
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
    <div class="row justify-content-around">
        <div class="col-12 col-md-4 ps-5 mt-3 text-center text-md-start">
            <img src="/public/assets/img/presentation.jpg" alt="photo du coach en plein exercice" class="img-fluid pb-3">
        </div>
        <div class="col-12 col-md-7 m-3">
            <div class="row">
                <div class="col-12 mb-3">
                    <h3>PRÉSENTATION</h3>
                </div>
                <div id="text-presentation" class="container col-12 text-white mb-1">
                    <span>
                        Je m’appelle Florent et je suis là pour vous <span class="words">aider</span>. Depuis 20 ans maintenant, je suis un passionné de musculation, un mode de vie qui a façonné non seulement mon physique, mais aussi mon esprit et ma discipline. J’ai créé ce site pour vous <span class="words">améliorer</span> sur les exercices, à avoir une meilleure posture et à éviter les blessures.
                        Que vous soyez débutant ou avancé, vous trouverez ici des <span class="words">conseils</span> adaptés à votre niveau. Ensemble, nous allons atteindre vos <span class="words">objectifs</span> et maximiser vos <span class="words">performances</span> tout en prenant soin de votre santé.
                    </span>
                </div>
                <div class="col-12 d-flex flex-row-reverse">
                    <a href="#" class="me-3">Lire la suite...</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mb-3">
    <div class="row justify-content-around">
        <div class="card col-3" style="width: 15rem;">
            <img class="card-img-top" src="/public/assets/img/fried-eggs.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">EXEMPLE DE MENUS POUR LA SÈCHE</h5>
                <p class="card-text-article">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a ..</p>
                <div class="btn btn-article">
                    Nutrition
                </div>
            </div>
        </div>
        <div class="card col-3" style="width: 15rem;">
            <img class="card-img-top" src="/public/assets/img/shoes.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">QUELLES CHAUSSURES POUR LA MUSCULATION</h5>
                <p class="card-text-article">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a ..</p>
                <div class="btn btn-article">
                    Training
                </div>
            </div>
        </div>
        <div class="card col-3" style="width: 15rem;">
            <img class="card-img-top" src="/public/assets/img/ride.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">MARCHER 30 MINUTES PAR JOUR</h5>
                <p class="card-text-article">Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a ..</p>
                <div class="btn btn-article">
                    Défi
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="btn btn-action col-2 mt-3">
                Plus d'articles
            </div>
        </div>
    </div>
</div>

<?php $main = ob_get_clean(); ?>