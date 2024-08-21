<?php


try {
    $exercise_id = intval(filter_input(INPUT_POST, 'exercise_id', FILTER_SANITIZE_NUMBER_INT));

    if (is_null($exercise_id)) {
        redirectToRoute('exercises/list-exercises');
    }
    // récupération d'exercice à modifier
    $exercise = Exercise::getOneExercise($exercise_id);

    // récupération de la liste des actégories
    $body_parts = BodyPart::getAllBodyParts();
} catch (\PDOException $e) {
    echo sprintf('La récupération de l\'exercice a échoué avec le message %s', $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $exercise_id = intval(filter_input(INPUT_POST, 'exercise_id', FILTER_SANITIZE_NUMBER_INT));
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $intro = filter_input(INPUT_POST, 'intro-hidden', FILTER_SANITIZE_SPECIAL_CHARS);
        $position = filter_input(INPUT_POST, 'position-hidden', FILTER_SANITIZE_SPECIAL_CHARS);
        $movement = filter_input(INPUT_POST, 'movement-hidden', FILTER_SANITIZE_SPECIAL_CHARS);
        $targeted_muscles = filter_input(INPUT_POST, 'targeted_muscles-hidden', FILTER_SANITIZE_SPECIAL_CHARS);
        $body_part_id = intval(filter_input(INPUT_POST, 'body_part_id', FILTER_SANITIZE_NUMBER_INT));
        $file = $_FILES['file']['name'] ?? null;

        if ($file) {
            $uploadDir =  __DIR__ . '/../../../public/uploads/exercises/';
            $tmp_name = $_FILES['file']['tmp_name'];
            if (isset($exercise->image) && file_exists($uploadDir . $exercise->image)) {
                unlink($uploadDir . $exercise->image);
            }

            $fileExtension = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
            $fileName = uniqid('exercise') . '.' . $fileExtension;

            if (move_uploaded_file($tmp_name, $uploadDir . $fileName)) {
                $image = $fileName;
            } else {
                $error['file'] = "Erreur lors du déplacement du fichier.";
                exit;
            }
        } else {
            $image = $exercise->image ?? null;
        }

        $exerciseModel = new Exercise(
            exercise_id: $exercise_id,
            title: $title,
            intro: $intro,
            position: $position,
            movement: $movement,
            targeted_muscles: $targeted_muscles,
            body_part_id: $body_part_id,
            image: $image
        );

        if ($exerciseModel->updateExercise()) {

            addFlash('success', 'Modification effectué avec succès !');
            redirectToRoute('exercises/list-exercises');
        }
    } catch (\PDOException $e) {
        echo sprintf('la modification de l\'exercice a échoué avec le message %s', $e->getMessage());
    }
}

$title = "Modifier l'exercice";
renderView('dashboard/exercises/update-exercise', compact('title', 'exercise', 'body_parts'));
