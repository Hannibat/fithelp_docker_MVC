<?php

$body_parts = BodyPart::getAllBodyParts();
$user = $_SESSION['user'];
$exercise_id = isset($_GET['exercise_id']) ? (int)$_GET['exercise_id'] : null;

if (is_null($exercise_id)) {
    header("Location: ?page=exercises/list-exercises");
    exit();
}

try {
    $exercise = Exercise::getOneExercise($exercise_id);

    if (!$exercise) {
    }

} catch (\PDOException $e) {
    // Gestion des erreurs lors de la récupération de l'exercise
    echo sprintf('La récupération de l\'exercise a échoué avec le message : %s', $e->getMessage());
    exit();
}

renderView('showCase/users/detail-exercise', compact('exercise', 'body_parts','user'));

?>