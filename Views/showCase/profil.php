<?php ob_start(); ?>

    <div class="profile-container">
        <h1>Profil de <?= htmlspecialchars($user->user_name) ?></h1>
        
        <div class="profile-info">
            <h2>Informations personnelles</h2>
            <p><strong>Nom :</strong> <?= htmlspecialchars($user->user_name) ?></p>
            <p><strong>Email :</strong> <?= htmlspecialchars($user->email) ?></p>
            <p><strong>Date de naissance :</strong> <?= htmlspecialchars($user->birthdate) ?></p>
            <p><strong>Genre :</strong> <?= htmlspecialchars($user->gender) ?></p>
        </div>

        <div class="profile-info">
            <h2>Modifier les informations</h2>
            <form action="update_profile.php" method="post">
                <div class="form-group">
                    <label for="user_name">Nom :</label>
                    <input type="text" id="user_name" name="user_name" class="form-control" value="<?= htmlspecialchars($user->user_name) ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($user->email) ?>" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Date de naissance :</label>
                    <input type="date" id="birthdate" name="birthdate" class="form-control" value="<?= htmlspecialchars($user->birthdate) ?>" required>
                </div>
                <div class="form-group">
                    <label for="gender">Genre :</label>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="male" <?= $user->gender === 'male' ? 'selected' : '' ?>>Homme</option>
                        <option value="female" <?= $user->gender === 'female' ? 'selected' : '' ?>>Femme</option>
                        <option value="other" <?= $user->gender === 'other' ? 'selected' : '' ?>>Autre</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>

    <?php $main = ob_get_clean(); ?>