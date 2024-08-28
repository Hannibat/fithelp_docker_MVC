<?php ob_start(); ?>

<div class="container article-container my-4">
    <!-- Article -->
    <article class="article-content">
        <!-- Titre de l'article -->
        <header class="article-header">
            <h1 class="exercise-title fs-3"><?= $title ?></h1>
        </header>

        <!-- Introduction de l'article -->
        <section class="article-intro my-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p>Dès mon enfance, j'étais en <span class="text-blueElec-regular">surpoids</span> et plutôt casanier. Avec les bonnes recettes de ma mère et de mes grand-mères, et une <span class="text-blueElec-regular">activité physique limitée</span>, comme le tir à l'arc ou le tir à la carabine, je n'étais <span class="text-blueElec-regular">pas très actif</span> et souffrir pour le sport ne m'intéressait pas.</p>
                </div>
                <div class="col-md-6">
                    <img src="/public/assets/img/flo13ans.webp" alt="Le coach a 13 ans devant un gateau d'anniversaire" class="img-fluid mb-4">
                </div>
            </div>
        </section>

        <!-- Contenu principal de l'article -->
        <section class="article-body mb-4">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <img src="/public/assets/img/flo-college.webp" alt="Le coach au collège avec un appareil dentaire" class="img-fluid mb-4">
                </div>
                <div class="col-md-6">
                    <p>Le collège a été une <span class="text-blueElec-regular">période difficile</span> pour moi en raison du <span class="text-blueElec-regular">harcèlement</span> que je subissais à cause de mon poids. Chaque jour, j'étais la cible d'insultes et de moqueries, au point que mon surnom était "cochon". Chaque soir, je rentrais chez moi en pensant à la journée difficile que je venais de vivre et je redoutais d'y retourner.</p>
                </div>
            </div>
        </section>

        <section class="article-body mb-4">
            <div class="row">
                <div class="col">
                    <p>Au lycée, j'ai perdu 10 kilos en un mois. J'ai cessé de manger à la cantine, car la nourriture y était peu appétissante, et j'avais envie de <span class="text-blueElec-regular">transformer mon corps</span>. J'ai commencé à pratiquer des <span class="text-blueElec-regular">sports plus physiques</span> comme le tennis de table et la boxe américaine.</p>
                </div>
            </div>
        </section>

        <section class="article-body mb-4">
            <div class="row align-items-center">
                <div class="col-md-7">
                    <p>J'ai <span class="text-blueElec-regular">découvert la musculation</span> à la fin du lycée, en commençant par m'entraîner uniquement les bras. Les résultats sont apparus rapidement et <span class="text-blueElec-regular">je me sentais bien</span>. <span class="text-blueElec-regular">Le regard des autres a changé</span>, ce qui m'a poussé à prendre la musculation plus au sérieux. J'ai alors aménagé une salle de sport dans le grenier de mes parents, en créant mes <span class="text-blueElec-regular">propres programmes d'entraînement</span> et en >approfondissant mes connaissances sur la <span class="text-blueElec-regular">nutrition</span>. C'est ainsi que ma <span class="text-blueElec-regular">passion</span> est née.</p>
                </div>
                <div class="col-md-5">
                    <img src="/public/assets/img/flomuscu.webp" alt="Le coach à la salle faisant du rowing barre sur une machine" class="img-fluid mb-4">
                </div>
            </div>
        </section>

        <!-- Conclusion de l'article -->
        <section class="article-conclusion">
            <div class="row">
                <div class="col">
                    <p>Mon parcours est là pour vous montrer qu'il est tout à fait possible de <span class="text-blueElec-regular">se transformer, peu importe d'où l'on part</span>. <span class="text-blueElec-regular">L'état d'esprit et le corps ne sont pas figés</span>; ce sont des éléments que l'on peut <span class="text-blueElec-regular">modeler et améliorer</span> au fil du temps. Avec la bonne attitude, de la <span class="text-blueElec-regular">persévérance</span> et des <span class="text-blueElec-regular">efforts soutenus</span>, il est possible d'accomplir des <span class="text-blueElec-regular">changements profonds et durables</span>. Prendre soin de son corps et de son mental est essentiel pour vivre une vie longue, saine et épanouie, sans avoir à regretter de ne pas avoir tenté de devenir la <span class="text-blueElec-regular">meilleure version de soi-même</span>. <span class="text-blueElec-regular">Ce chemin n'est pas toujours facile, mais les récompenses en valent chaque instant.</span></p>
                </div>
            </div>
        </section>
    </article>
</div>

<?php $main = ob_get_clean(); ?>
