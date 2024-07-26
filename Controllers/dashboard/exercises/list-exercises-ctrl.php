<?php

try {
    // instance du modèle
    $exercisesModel = new Exercise();
    $bodyPartModel = new BodyPart();
    $body_parts = $bodyPartModel->getAllBodyParts();
    $exercises = $exercisesModel->getAllExercises();

    // Si les données du formulaire ont été transmises pour la suppression du véhicule
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])) {
        $exercise_id = filter_input(INPUT_POST, 'exercise_id', FILTER_VALIDATE_INT);

        if ($exercise_id) {
            $exercisesModel->setExerciseId($exercise_id);
            if ($exercisesModel->deleteExercise()) {
                $success['delete'] = "Exercice supprimé avec succès!";
            } else {
                $error['delete'] = "Erreur lors de la suppression de l'exercice.";
            }
        } else {
            $error['delete'] = "Données invalides pour la suppression de l'exercice.";
        }
    }
    // if (isset($_GET['categorie_id'])) {

    //     $categorie_id = filter_input(INPUT_GET, 'categorie_id', FILTER_SANITIZE_SPECIAL_CHARS);
    //     $vehicles = $vehiclesModel->getCategory($categorie_id);
    //}
} catch (\PDOException $ex) {
    echo sprintf('la récupération des catégories a échoué avec le message %s', $ex->getMessage());
    die;
}

$title = "Liste des exercises";

renderView('dashboard/exercises/list-exercises', compact('title', 'exercises', 'body_parts'));
