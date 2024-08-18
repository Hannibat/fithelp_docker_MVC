<?php


try {
    $user = $_SESSION['user'];
    
    // Récupération des données
    $body_parts = BodyPart::getAllBodyParts();
    $exercises = Exercise::getAllExercises();

} catch (\PDOException $e) {
    echo sprintf('la récupération des exercices a échoué avec le message %s', $e->getMessage());
    die;
}

$title = "Liste des exercises";

renderView('dashboard/exercises/list-exercises', compact('title', 'exercises', 'body_parts','user'));
