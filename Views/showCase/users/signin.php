<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <!-- Colonne d'inscription -->
        <div class="col-md-6 order-1 order-md-2 d-flex align-items-center my-3">
            <div class="p-3 border rounded text-center">
                <h3>Pas de compte ?</h3>
                <p>Inscrivez-vous dès maintenant pour accéder à la totalité du site.</p>
                <a href="http://localhost:8001/?page=users/signup" class="btn btn-success">S'inscrire</a>
            </div>
        </div>

        <!-- Formulaire de connexion -->
        <div class="col-md-6 order-2 order-md-1">
            <form method="post">
                <fieldset>
                    <legend><?= $title ?></legend>
                    <?= $errors['email'] ?? '' ?>
                    <?= $errors['auth'] ?? '' ?>
                    <?php if (isset($error['user'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($error['user']) ?>
                        </div>
                    <?php elseif (isset($error['login'])) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= htmlspecialchars($error['login']) ?>
                        </div>
                    <?php endif; ?>

                    <div class="mb-3">
                        <label for="email" class="form-label mt-2">Email</label>
                        <input type="email" name="email" class="form-control" id="email" required aria-describedby="emailHelp" placeholder="Entrez votre email">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label mt-4">Votre mot de passe</label>
                        <input type="password" name="password" class="form-control" required id="password" aria-describedby="passwordHelp" placeholder="*******">
                    </div>
                </fieldset>

                <button type="submit" class="btn btn-primary mb-4">Se connecter</button>
            </form>
        </div>
    </div>
</div>
<?php $main = ob_get_clean(); ?>