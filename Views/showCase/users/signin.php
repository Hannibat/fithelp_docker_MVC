<?php ob_start(); ?>
<div class="container">
    <div class="row col-md-7">
        <form method="post">
            <fieldset>
                <legend><?= $title ?></legend>
                <?= $errors['email'] ?? '' ?>
                <?= $errors['auth'] ?? '' ?>
                <div class="mb-3">
                    <label for="email" class="form-label mt-4">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required aria-describedby="emailHelp" placeholder="Enter email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label mt-4">Votre mot de passe</label>
                    <input type="password" name="password" class="form-control" required id="password" aria-describedby="passwordHelp" placeholder="*******">
                </div>

            </fieldset>

            <button type="submit" class="btn btn-primary">Se connecter</button>
        </form>
    </div>
</div>
<?php $main = ob_get_clean(); ?>