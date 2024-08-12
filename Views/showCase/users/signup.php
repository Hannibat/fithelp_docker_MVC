<?php ob_start(); ?>
<div class="container">
    <div class="row col-md-7 m-3">
        <form method="post">
            <fieldset>
                <legend><?= $title ?></legend>

                <div><span class="text-danger">Les champs * sont obligatoires</span></div>
                <div class="mb-1">
                    <label for="user_name" class="form-label mt-4">Nom d'utilisateur<span class="text-danger"> *</span></label>
                    <input type="text" name="user_name" class="form-control <?= isset($error['userName']) ? 'errorField' : '' ?>" id="user_name" required
                    placeholder="Jean" value="<?= htmlentities($userName ?? '') ?>" minlength="2" maxlength="30" pattern="^[A-Za-z-éèêëàâäôöûüç' -]+$" title="Le nom de l'utilisateur doit contenir des lettres et entre 2 à 30 caractères">
                    <small id="userNameError" class="form-text error"><?= $error['userName'] ?? '' ?></small>
                </div>

                <div class="mb-1">
                    <label for="email" class="form-label mt-4">Email<span class="text-danger"> *</span></label>
                    <input type="email" name="email" class="form-control <?= isset($error['email']) ? 'errorField' : '' ?>" id="email" required placeholder="jean.dupond@gmail.com" value="<?= htmlentities($emailValidate ?? '') ?>">
                    <small id="emailError" class="form-text error"><?= $error['email'] ?? '' ?></small>
                </div>

                <div class="mb-1">
                    <label for="password" class="form-label mt-4">Votre mot de passe<span class="text-danger"> *</span></label>
                    <input type="password" name="password" class="form-control <?= isset($error['password']) ? 'errorField' : '' ?>" id="password" required 
                    placeholder="*******" minlength="8" pattern="(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,}$" title="Veuillez saisir un mot de passe avec minimum 8 caractères et au moins : 
               - un nombre
               - une majuscule
               - une minuscule">
                    <small id="passwordError" class="form-text error"><?= $error['password'] ?? '' ?></small>
                </div>

                <div class="mb-1">
                    <label for="confirmPassword" class="form-label mt-4">Confirmation<span class="text-danger"> *</span></label>
                    <input type="password" name="confirmPassword" class="form-control <?= isset($error['confirmPassword']) ? 'errorField' : '' ?>" id="confirmPassword" required placeholder="*******">
                    <small id="confirmPasswordError" class="form-text error"><?= $error['confirmPassword'] ?? '' ?></small>
                </div>

                <div class="mb-1">
                    <label for="birthdate" class="form-label mt-4">Date de naissance<span class="text-danger"> *</span></label>
                    <input type="date" name="birthdate" class="form-control <?= isset($error['birthdate']) ? 'errorField' : '' ?>" id="birthdate" required 
                    value="<?= htmlentities($birthdate ?? '') ?>" min="<?= date('Y-m-d', strtotime('-120 years'))?>" max="<?= date('Y-m-d', strtotime('-12 years')) ?>" pattern="<?php REGEX_BIRTHDATE ?>">
                    <small id="birthdateError" class="form-text error"><?= $error['birthdate'] ?? '' ?></small>
                </div>

                <div class="mb-1">
                    <label for="gender" class="form-label mt-4">Genre<span class="text-danger">*</span></label>
                    <select name="gender" class="form-control <?= isset($error['gender']) ? 'errorField' : '' ?>" id="gender" required>
                        <option value="">Sélectionnez</option>
                        <option value="M" <?= isset($gender) && $gender == "M" ? 'selected' : '' ?>>Homme</option>
                        <option value="Mme" <?= isset($gender) && $gender == "Mme" ? 'selected' : '' ?>>Femme</option>
                    </select>
                    <small id="genderError" class="form-text error"><?= $error['gender'] ?? '' ?></small>
                </div>

            </fieldset>

            <button type="submit" class="btn btn-primary mt-3">S'inscrire</button>
        </form>
    </div>
</div>


<?php $main = ob_get_clean(); ?>