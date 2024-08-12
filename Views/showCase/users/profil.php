<?php ob_start(); ?>

<div class="container mt-5">
    <div class="row">
        <!-- Dashboard admin -->
        <?php if ($user->role == 1) : ?>
            <div class="col-12 col-md-3 mb-4">
                <div class="list-group rounded bg-blueElec p-3">
                    <h4 class="mb-3 text-white">Dashboard Admin</h4>
                    <button class="list-group-item list-group-item-action" id="toggleExercises">
                        Exercices
                    </button>
                    <div id="exercisesList" class="d-none pl-3">
                        <a href="?page=exercises/add-exercise" class="list-group-item list-group-item-action">Créer un exercice</a>
                        <a href="?page=exercises/list-exercises" class="list-group-item list-group-item-action">Liste des exercices</a>
                    </div>
                    <a href="articles.php" class="list-group-item list-group-item-action">Articles</a>
                    <a href="programs.php" class="list-group-item list-group-item-action">Programmes</a>
                    <a href="users.php" class="list-group-item list-group-item-action">Utilisateurs</a>
                </div>
            </div>
        <?php endif; ?>

        <div class="col-12 <?= $user->role == 1 ? 'col-md-9' : '' ?>">
            <h1 class="text-center mb-4">Profil de <?= htmlspecialchars($user->user_name) ?></h1>

            <!-- Informations de l'utilisateur -->
            <div class="profile-container p-4 shadow-lg rounded bg-light mb-4">
                <div class="profile-info mb-4">
                    <h3>Informations personnelles</h3>
                    <p><span class="strong">Nom d'utilisateur :</span> <?= htmlspecialchars($user->user_name) ?></p>
                    <p><span class="strong">Email :</span> <?= htmlspecialchars($user->email) ?></p>
                    <p><span class="strong">Date de naissance :</span> <?= htmlspecialchars($formattedBirthdate) ?></p>
                    <?php if ($isBirthday) : ?>
                        <p class="text-success"><span class="strong">Bon anniversaire ! 🎉</span></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Calcul de l'IMC -->
            <div class="profile-container p-3 ps-4 shadow-lg rounded bg-light mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Calculer son IMC</h3>
                    <button class="btn btn-primary btn-lg" id="toggleIMCForm">
                        <span id="toggleSymbol" class="plus-sign">+</span>
                    </button>
                </div>

                <div id="imcForm" class="d-none mt-4">
                    <form id="imcFormEvent" method="POST" action="">
                        <div class="form-group mb-3">
                            <label for="height">Taille (en cm) :</label>
                            <input type="number" step="0.01" id="height" name="height" class="form-control" placeholder="Taille en cm" min="50" max="250" value="<?= isset($datas->height) ?>" required>
                            <span class="text-danger"><?= $error['height'] ?? '' ?></span>
                        </div>
                        <div class="form-group mb-3">
                            <label for="weight">Poids (en kg) :</label>
                            <input type="number" step="0.01" id="weight" name="weight" class="form-control" placeholder="Poids en kg" min="20" max="300" value="<?= $datas->weight ?? '' ?>" required>
                            <span class="text-danger"><?= $error['weight'] ?? '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-success">Calculer IMC</button>
                    </form>
                    <?php foreach ($datas as $data) : ?>
                        <?php $imc = ($data->weight / ($data->height * $data->height)) * 10000;
                        $imc = number_format($imc, 2); ?>
                        <?php if ($imc < 18.5) { ?>
                            <div class="my-2">Le <?= date('d/m/Y', strtotime($data->created_at)) ?> votre IMC était de <span class="bg-info text-white"><?= $imc ?></span> avec un poids de <span class="fw-semibold"><?= $data->weight ?> kg</span>.</div>
                        <?php } elseif ($imc >= 18.5 && $imc < 24.9) { ?>
                            <div class="my-2">Le <?= date('d/m/Y', strtotime($data->created_at)) ?> votre IMC était de <span class="bg-success text-light"><?= $imc ?></span> avec un poids de <span class="fw-semibold"><?= $data->weight ?> kg</span>.</div>
                        <?php } elseif ($imc >= 25 && $imc < 29.9) { ?>
                            <div class="my-2">Le <?= date('d/m/Y', strtotime($data->created_at)) ?> votre IMC était de <span class="bg-warning text-light"><?= $imc ?></span> avec un poids de <span class="fw-semibold"><?= $data->weight ?> kg</span>.</div>
                        <?php } elseif ($imc >= 30 && $imc < 34.9) { ?>
                            <div class="my-2">Le <?= date('d/m/Y', strtotime($data->created_at)) ?> votre IMC était de <span class="bg-orange text-light"><?= $imc ?></span> avec un poids de <span class="fw-semibold"><?= $data->weight ?> kg</span>.</div>
                        <?php } elseif ($imc > 35) { ?>
                            <div class="my-2">Le <?= date('d/m/Y', strtotime($data->created_at)) ?> votre IMC était de <span class="bg-danger text-light"><?= $imc ?></span> avec un poids de <span class="fw-semibold"><?= $data->weight ?> kg</span>.</div>
                        <?php } else { ?>
                            <div class="my-2">Le <?= date('d/m/Y', strtotime($data->created_at)) ?> votre IMC était de <span><?= $imc ?> avec un poids de <span class="fw-semibold"><?= $data->weight ?></span> kg.</div>
                        <?php } ?>
                    <?php endforeach; ?>
                    <div class="text-center">
                        <img class="img-fluid" src="/public/assets/img/roue-calcul-imc.png" alt="roue calcul IMC">
                    </div>
                </div>
            </div>

            <!-- Calcul des besoins caloriques -->
            <div class="profile-container p-3 ps-4 shadow-lg rounded bg-light mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Calculer vos besoins caloriques</h3>
                    <button class="btn btn-primary btn-lg" id="toggleCaloriesForm">
                        <span id="toggleSymbolCalories" class="plus-sign">+</span>
                    </button>
                </div>

                <?php if (!$imc) : ?>
                    <p class="text-danger">Il faut d'abord calculer son IMC</p>
                <?php endif; ?>

                <div id="caloriesForm" class="d-none mt-4">
                    <form id="caloriesFormEvent" method="POST" action="">
                        <div class="form-group mb-3">
                            <label for="activity">Activité quotidienne :</label>
                            <select id="activity" name="activity" class="form-control" required>
                                <option value="">Sélectionner</option>
                                <option value="1.2">Sédentaire (peu ou pas d'exercice)</option>
                                <option value="1.375">Activité légère (exercices 1-3 jours/semaine)</option>
                                <option value="1.55">Activité modérée (exercices 3-5 jours/semaine)</option>
                                <option value="1.725">Activité intense (exercices 6-7 jours/semaine)</option>
                                <option value="1.9">Activité très intense (exercice très intense/sportif professionnel)</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success">Calculer Besoin Calorique</button>
                    </form>
                    <?php
                    $birthDate = new DateTime($user->birthdate);
                    $currentDate = new DateTime();
                    $age = $currentDate->diff($birthDate);
                    ?>
                    <?php if ($user->gender == 1) {
                        $calculCal = 88.362 + (13.397 * $datas->weight) + (4.799 * $datas->height) - (5.677 * $age->y);
                    } else {
                        $calculCal = 447.593 + (9.247 * $datas->weight) + (3.098 * $datas->height) - (4.330 * $age->y);
                    } ?>
                </div>
            </div>

            <!-- Supprimer le compte -->
            <div class="d-flex justify-content-center m-4">
                <form action="update_profile.php" method="post">
                    <button type="submit" class="btn btn-danger btn-block">Supprimer son compte</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php $main = ob_get_clean(); ?>