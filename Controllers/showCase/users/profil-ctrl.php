<?php

try {
    // Récupération de l'utilisateur
    $user = $_SESSION['user'];
    $user_id = $user->user_id;
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

    $datas = Data::getAllData();

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
        // Instance du modèle
        $calorieModel = new Calorie(
            lvl_act: $activityLevel,
            user_id: $user_id
        );

        if ($calorieModel->addCalorieCalculate()) {
            
        } else {
            $error['data'] = "Erreur lors de l'ajout du poids et de la taille.";
        }
    }

}
} catch (\PDOException $e) {
    echo sprintf('La récupération de l\'utilisateur a échoué avec le message %s', $e->getMessage());
    exit;
}

$title = "Profil";

renderView('showCase/users/profil', compact('title', 'user', 'formattedBirthdate', 'isBirthday', 'datas'));
