<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <title>Fithelp</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header>
        <!-- Navbar responsive -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!-- Logo -->
                <a href="http://localhost:8001" class="navbar-brand">
                    <img src="/public/assets/img/logo/FIT.HELP-name.png" alt="logo" class="logo_desktop" width="170" height="50">
                </a>

                <!-- Bouton pour mobile -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Liens navbar -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <?php if (isset($_SESSION['user']) && $_SESSION['user']) { ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="?page=exercises/list-exercises">Exercices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Programmes</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="http://localhost:8001/?page=users/signin">Exercices</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="http://localhost:8001/?page=users/signin">Programmes</a>
                            </li>
                        <?php } ?>
                        <li class="nav-item">
                            <a class="nav-link" href="http://localhost:8001/?page=articles/list-articles">Articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="?page=showCase/presentation">Présentation</a>
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
                            <li class="nav-item">
                                <a class="nav-link" href="?page=users/profil">
                                    <img src="/public/assets/img/icons8-utilisateur-50.png" alt="photo de profil" width="40" height="40" class="rounded-circle">
                                </a>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link btn" data-bs-toggle="modal" data-bs-target="#confirmLogoutModal">Déconnexion</button>
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

    <footer class="mt-auto">
        <!-- footer mobile -->
        <div class="container-fluid bg-iron d-md-none">
            <div class="row text-center align-items-center justify-content-between py-3">
                <div class="col-4 text-white">
                    <a href="#contactModal" aria-label="Formulaire Contact" id="contactButtonText" class="contact-button text-white">Contact</a>
                </div>
                <div class="col-4 text-white">
                    <a href="https://www.instagram.com/coach_flo.flex/" aria-label="Instagram">
                        <img src="/public/assets/img/socialinsta.png" alt="logo instagram" width="35" height="35">
                    </a>
                </div>
                <div class="col-4 text-white">
                    <a href="#" aria-label="Retour en haut de la page">
                        <img src="/public/assets/img/icons8-forward-26.png" alt="fleche pour revenir en haut" width="18" height="18">
                        <span class="text-white">Haut de page</span>
                    </a>
                </div>
                <div class="col-6 mt-3 text-white">
                    <div>Politique de confidentialité</div>
                    <div>Mentions légales</div>
                </div>
                <div class="col-6 mt-3 text-white">
                    <div>Source photos : Pixabay & Unsplash</div>
                    <div>©FIT.HELP</div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div id="contactModal" class="contact-modal">
            <div class="contact-modal-content">
                <span class="contact-modal-close">&times;</span>
                <h2>Contactez-nous</h2>
                <form id="contactForm">
                    <div>
                        <label for="name">Nom:</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div>
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="message">Message:</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>

        <!-- Message d'erreur ou succès -->
        <div id="flashMessage" class="flash-message"></div>


        <!-- footer pc -->
        <div class="container-fluid bg-iron d-none d-md-block">
            <div class="row text-center align-items-center justify-content-around py-3">
                <div class="col-md-4 text-white">
                    <address>
                        <div>Me contacter</div>
                        <a href="#contactModal" aria-label="Formulaire Contact" id="contactButtonIcon" class="contact-button">
                            <img src="/public/assets/img/contact-icon.png" alt="icône contact" width="50" height="50" class="mt-3 mx-2 contact-icon">
                        </a>
                        <a href="https://www.instagram.com/coach_flo.flex/" aria-label="Instagram">
                            <img src="/public/assets/img/socialinsta.png" alt="logo Instagram" width="50" height="50" class="mt-3 mx-2">
                        </a>
                    </address>
                </div>

                <!-- Liens de navigation -->
                <nav class="col-md-4 text-white">
                    <ul class="nav flex-column">
                        <li class="nav-item"><a class="text-white" href="?page=exercises/list-exercises">Exercices</a></li>
                        <li class="nav-item"><a class="text-white" href="#programs">Programmes</a></li>
                        <li class="nav-item"><a class="text-white" href="?page=articles/list-articles">Articles</a></li>
                        <li class="nav-item"><a class="text-white" href="?page=showCase/presentation">Présentation</a></li>
                    </ul>
                </nav>
            </div>

            <!-- Section inférieure -->
            <div class="row justify-content-between text-center">
                <div class="col-md-6 text-white mb-2">
                    <div>Politique de confidentialité</div>
                    <div>Mentions légales</div>
                </div>
                <div class="col-md-6 text-white mb-2">
                    <div>Source photos : Pixabay & Unsplash</div>
                    <div>©FIT.HELP</div>
                </div>
            </div>
        </div>
        </div>

    </footer>
    <script src="/public/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/public/assets/js/script.js"></script>
    <script src="/public/assets/js/ajaxContact.js"></script>
    <script src="/public/assets/js/favorite.js"></script>
    <script src="/public/assets/js/modalDeleteEx.js"></script>
    <script src="/public/assets/js/modalDeleteUser.js"></script>
    <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>
    <script type="text/javascript">
        (function() {
            emailjs.init("ztkG0McU1amELg379");
        })();
    </script>
</body>

</html>