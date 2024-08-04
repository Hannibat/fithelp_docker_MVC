<?php ob_start(); ?>
<div class="container">
    <div class="row col-md-7">
        <form method="post">
            <fieldset>
                <legend><?= $title ?></legend>

                <div class="mb-3">
                    <label for="user_name" class="form-label mt-4">Nom d'utilisateur</label>
                    <input type="text" name="user_name" class="form-control" id="user_name" required placeholder="Nom d'utilisateur">
                    <?= $errors['user_name'] ?? '' ?>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label mt-4">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required aria-describedby="emailHelp" placeholder="Enter email">
                    <?= $errors['email'] ?? '' ?>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label mt-4">Votre mot de passe</label>
                    <input type="password" name="password" class="form-control" required id="password" aria-describedby="passwordHelp" placeholder="*******">
                    <?= $errors['password'] ?? '' ?>
                </div>

                <div class="mb-3">
                    <label for="confirmPassword" class="form-label mt-4">Confirmation</label>
                    <input type="password" name="confirmPassword" required class="form-control" id="confirmPassword" aria-describedby="confirmPasswordHelp" placeholder="*******">
                    <?= $errors['password'] ?? '' ?>
                </div>

                <div class="mb-3">
                    <label for="birthdate" class="form-label mt-4">Date de naissance</label>
                    <input type="date" name="birthdate" class="form-control" id="birthdate" required>
                    <?= $errors['birthdate'] ?? '' ?>
                </div>

                <div class="mb-3">
                    <label for="gender" class="form-label mt-4">Genre</label>
                    <select name="gender" class="form-control" id="gender" required>
                        <option value="">Sélectionnez</option>
                        <option value="1">Homme</option>
                        <option value="0">Femme</option>
                    </select>
                    <?= $errors['gender'] ?? '' ?>
                </div>

            </fieldset>

            <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>
</div>


<?php $main = ob_get_clean(); ?>