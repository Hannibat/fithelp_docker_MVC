<?php

try {
    // Récupération des données
    $body_parts = BodyPart::getAllBodyParts();

    
    // Récupération de l'utilisateur
    $user = $_SESSION['user'];
    $user_id = $user->user_id;
    
    // Appelez la méthode avec les paramètres
    $exercises = Mark::getAllExercisesForUser($user_id);

    // Appel de la méthode pour obtenir les exercices favoris de l'utilisateur
    // $exercises = Exercise::getAllExercisesForUser($user_id);

    // Récupération de la date de naissance
    $birthdate = $user->birthdate;

    // Convertir la date au format français
    $formattedBirthdate = date('d/m/Y', strtotime($birthdate));

    // Extraire le jour et le mois de la date de naissance
    $birthDay = date('d', strtotime($user->birthdate));
    $birthMonth = date('m', strtotime($user->birthdate));

    // Obtenir la date actuelle
    $todayDay = date('d');
    $todayMonth = date('m');

    // Vérifier si aujourd'hui est l'anniversaire
    $isBirthday = ($birthDay == $todayDay && $birthMonth == $todayMonth);

    // Récupération de toutes les données poids et taille selon l'id de l'utilisateur
    $datasUser = Data::getAllData($user_id) ?? [];

    // Récupération des dernières données ajoutées en taille et poids par l'utilisateur
    $lastDataUser = Data::getOneDataUser($user_id) ?? '';

    // Récupération de la dernière donnée ajoutée de niveau d'activité existant par l'utilisateur
    $lvl_act = Calorie::getOneLvlActUser($user_id) ?? '';
    // Initialiser la variable $calorie_calculate_id si elle existe déjà
    // $calorie_calculate_id = $lvl_act ? $lvl_act->calorie_calculate_id : null;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
        $error = [];

        // Vérification des champs obligatoires
        if (!$weight) {
            $error['weight'] = 'Ce champ est obligatoire!';
        }
        if (!$height) {
            $error['height'] = 'Ce champ est obligatoire!';
        }

        // Vérification des limites de poids et de taille
        if ($weight < 20 || $weight > 300) {
            $error['weight'] = 'Le poids doit être compris entre 20 kg et 300 kg.';
        }
        if ($height < 50 || $height > 250) {
            $error['height'] = 'La taille doit être comprise entre 50 cm et 250 cm.';
        }

        if (empty($error)) {
            // Instance du modèle
            $dataModel = new Data(
                weight: $weight,
                height: $height,
                user_id: $user_id
            );

            if ($dataModel->addData()) {
                // function calculateIMC($weight, $height) {
                //     return ($weight / ($height * $height)) * 10000;
                // }

                // // Calcul de l'IMC
                // $imc = calculateIMC($weight, $height);
            } else {
                $error['data'] = "Erreur lors de l'ajout du poids et de la taille.";
            }
        }

        
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $activityLevel = filter_input(INPUT_POST, 'activity', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $error = [];

    if (!$activityLevel) {
        $error['activityLevel'] = 'Ce champ est obligatoire!';
    }
    if ($activityLevel < 1.2 || $activityLevel > 1.9) {
        $error['activityLevel'] = 'La valeur n\'est pas correcte.';
    }
    if (empty($error)) {
        $calorieModel = new Calorie(
            lvl_act: $activityLevel,
            user_id: $user_id
        );
    
        if ($calorieModel->addLvlAct()) {
            
        } else {
            $error['data'] = "Erreur lors de l'ajout du niveau d'activité.";
        }
    }

    // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //     if($user_id) {
    //         $deleteUser = User::deleteUser($user_id);
    //         $deleteUserData = Data::deleteDataByUserId($user_id);
    //         $deleteUserCalories = Calorie::deleteLvlActByUserId($user_id);
    //         if($deleteUser && $deleteUserData && $deleteUserCalories) {
    //             redirectToRoute('showCase/home');
    //             die;
    //         }
    //     }
    // }
}
} catch (\PDOException $e) {
    echo sprintf('La récupération de l\'utilisateur a échoué avec le message %s', $e->getMessage());
    exit;
}

$title = "Profil";

renderView('showCase/users/profil', compact('title', 'user', 'formattedBirthdate', 'isBirthday', 'datasUser', 'lvl_act','lastDataUser', 'exercises','body_parts'));
