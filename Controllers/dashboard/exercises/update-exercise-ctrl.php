<?php
$exercise_id = $_GET['exercise_id'] ?? null;
if (is_null($exercise_id)) {
    redirectToRoute('exercises/list-exercises');
}

try {
    // instance du modèle Exercise
    $exerciseModel = new Exercise();
    // récupération de l'exercice choisi
    $exercise = $exerciseModel->getOneExercise($exercise_id);

    // instance du modèle
    $bodyPartModel = new BodyPart();
    // récupération de la liste des parties du corps
    $body_parts = $bodyPartModel->getAllBodyParts();
} catch (\PDOException $ex) {
    echo sprintf('la récupération de l\'exercice a échoué avec le message %s', $ex->getMessage());
}

$title = "Modifier l'exercice";

renderView('dashboard/exercises/update-exercise', compact('title', 'exercise', 'body_parts'));
