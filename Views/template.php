<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/font/font.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <title>Fithelp</title>
</head>

<body>
    <header>
        <!-- Version mobile -->
        <nav class="mobile d-md-none ">
            <div class="container-fluid d-flex justify-content-between mt-2">
                <div class="col-9">
                    <img src="/public/assets/img/logo/FIT.HELP-name.png" alt="logo fit" width="102" height="30">
                </div>
                <div class="col-1">
                    <img src="/public/assets/img/icons8-utilisateur-50.png" alt="photo de profil" width="30" height="30">
                </div>
                <div class="col-1">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                        <img src="/public/assets/img/icons8-menu-50.png" alt="icon menu" width="30" height="30">
                    </button>
                </div>
            </div>
            <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-light p-4 text-start text-dark">
                    <h5 class="text-blueElec-bold my-3 >Exercices</h5>
                    <h5 class=" text-blueElec-bold my-3>Programmes</h5>
                    <h5 class="text-blueElec-bold my-3">Articles</h5>
                    <h5 class="text-blueElec-bold my-3">Présentation</h5>
                </div>
            </div>
        </nav>

        <!-- Version tablette -->
        <nav class="tablet navbar navbar-expand justify-content-center d-none d-md-block d-lg-none">
            <div class="container-fluid row me-1">
                <div class="col-4">
                    <img src="/public/assets/img/logo/FIT.HELP-name.png" alt="logo fit" width="136" height="40">
                </div>
                <div class="collapse navbar-collapse col-8 d-flex justify-content-between" id="navbarSupportedContent">
                    <ul class="navbar-nav vw-100 justify-content-between">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="#">Exercices</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Programmes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-1" href="#">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Présentation</a>
                        </li>
                        <li>
                            <img class="mt-1" src="/public/assets/img/icons8-utilisateur-50.png" alt="photo de profil" width="40" height="40">
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Version pc -->
        <nav class="desktop navbar navbar-expand d-flex d-none d-lg-block">
            <div class="container-fluid row">
                <div class="col-4">
                    <a href="http://localhost:8001"><img src="/public/assets/img/logo/FIT.HELP-name.png" alt="logo" class="logo_desktop" width="170" height="50"></a>
                </div>
                <div class="collapse navbar-collapse col-8 d-flex" id="navbarSupportedContent">
                    <ul class="navbar-nav vw-100 justify-content-between">
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']) { ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="?page=exercises/list-exercises">Exercices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Programmes</a>
                            </li>
                        <?php } else {?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="http://localhost:8001/?page=users/signup">Exercices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost:8001/?page=users/signup">Programmes</a>
                            </li>
                            <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Présentation</a>
                        </li>
                        <?php if (!isset($_SESSION['user']) || !$_SESSION['user']) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="/?page=users/signup">Inscription</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/?page=users/signin">Connexion</a>
                            </li>
                        <?php } ?>
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']) { ?>
                            <li>
                                <a href="?page=users/profil">
                                    <img class="mt-1" src="/public/assets/img/icons8-utilisateur-50.png" alt="photo de profil" width="50" height="50">
                                </a>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal">Déconnexion</button>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Modal de confirmation de déconnexion -->
    <div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="confirmLogoutModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmLogoutModalLabel">Confirmer la déconnexion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir vous déconnecter ?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <a href="/?page=users/signout" class="btn btn-primary">Déconnexion</a>
                </div>
            </div>
        </div>
    </div>

    <main>
        <?= $main ?>
    </main>

    <footer>
        <!-- footer mobile -->
        <div class="container-fluid bg-blueElec d-md-none">
            <div class="row text-center align-items-center py-3">
                <div class="col-6 text-white">
                    <div>Contact</div>
                </div>
                <div class="col-6 text-white">
                    <img src="/public/assets/img/icons8-forward-26.png" alt="fleche pour revenir en haut" width="18" height="18">
                    <span>Haut de page</span>
                </div>
                <div class="col-6 mt-3 text-white">
                    <div>Politique de confidentialité</div>
                    <div>Mentions légales</div>
                </div>
                <div class="col-6 mt-3 text-white">
                    <div>Source photos : Pixabay & Unsplash</div>
                    <div>©FIT.HELP</div>
                </div>
                <div class="col-12 my-2 text-white">
                    <a href="https://instagram.com" aria-label="Instagram">
                        <img src="/public/assets/img/socialinsta.png" alt="logo instagram" width="35" height="35">
                    </a>
                </div>
            </div>
        </div>

        <!-- footer pc  -->
        <div class="container-fluid bg-blueElec d-none d-md-block">
            <div class="row text-center align-items-center py-3">
                <div class="col-md-4 text-white">
                    <address>
                        <div>Me contacter</div>
                    </address>
                </div>
                <div class="col-md-4">
                    <a href="#home" aria-label="Logo Fit.Help">
                        <img src="/public/assets/img/logo/FIT.HELP-logo.png" alt="logo FIT.HELP" width="140" height="200">
                    </a>
                </div>
                <nav class="col-md-4 text-white">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class=" text-white" href="#exercises">Exercices</a></li>
                        <li class="nav-item"><a class=" text-white" href="#programs">Programmes</a></li>
                        <li class="nav-item"><a class=" text-white" href="#articles">Articles</a></li>
                        <li class="nav-item"><a class=" text-white" href="#about">Présentation</a></li>
                    </ul>
                </nav>
                <div class="col-md-4 text-white mb-2">
                    <div>Politique de confidentialité</div>
                    <div>Mentions légales</div>
                </div>
                <div class="col-md-4 text-white mb-2">
                    <a href="#" aria-label="Instagram">
                        <img src="/public/assets/img/socialinsta.png" alt="logo instagram" width="60" height="60">
                    </a>
                </div>
                <div class="col-md-4 text-white mb-2">
                    <div>Source photos : Pixabay & Unsplash</div>
                    <div>©FIT.HELP</div>
                </div>
            </div>
        </div>
    </footer>
    <script src="/public/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/public/assets/js/script.js"></script>
</body>

</html>