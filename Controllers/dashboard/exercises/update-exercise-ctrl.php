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

    // instance du modèle BodyPart
    $bodyPartModel = new BodyPart();
    // récupération de la liste des parties du corps
    $body_parts = $bodyPartModel->getAllBodyParts();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['update'])) {
            $exercise_id = filter_input(INPUT_POST, 'exercise_id', FILTER_VALIDATE_INT);
            var_dump($exercise_id);
            $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
            var_dump($title);
            $intro = filter_input(INPUT_POST, 'intro-hidden', FILTER_SANITIZE_SPECIAL_CHARS);
            var_dump($intro);
            $position = filter_input(INPUT_POST, 'position-hidden', FILTER_SANITIZE_SPECIAL_CHARS);
            var_dump($position);
            $movement = filter_input(INPUT_POST, 'movement-hidden', FILTER_SANITIZE_SPECIAL_CHARS);
            var_dump($movement);
            $targeted_muscles = filter_input(INPUT_POST, 'targeted_muscles-hidden', FILTER_SANITIZE_SPECIAL_CHARS);
            var_dump($targeted_muscles);
            $body_part_id = filter_input(INPUT_POST, 'body_part', FILTER_SANITIZE_NUMBER_INT);
            var_dump($body_part_id);

            if ($exercise_id && $title && $intro && $position && $movement && $targeted_muscles && $body_part_id) {
                $exercise->setTitle($title);
                $exercise->setIntro($intro);
                $exercise->setPosition($position);
                $exercise->setMovement($movement);
                $exercise->setTargetedMuscles($targeted_muscles);
                $exercise->setBodyPartId($body_part_id);
            }; 
                if ($exerciseModel->updateExercise()) {
                    echo "Exercice mis à jour avec succès!";
                } else {
                    echo "Erreur lors de la mise à jour de l'exercice.";
                }
            } else {
                echo "Données invalides pour la mise à jour.";
            }
        }

        if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $picture = $_FILES['file'];
            // Configuration des contraintes de téléchargement
            $sizeMax = 2 * 1024 * 1024; // 2 MB
            $extensions = ['png', 'jpg', 'jpeg', 'gif'];
            $uploadDir = __DIR__ . '/../../../public/uploads/exercises/';

            $fileName = basename($picture['name']);
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $fileSize = $picture['size'];
            $fileTmpName = $picture['tmp_name'];
            $fileError = $picture['error'];

            if ($fileError === UPLOAD_ERR_OK) {
                if (!in_array($fileExtension, $extensions)) {
                    $error['addImg'] = "Format de fichier non autorisé. Seuls les formats PNG, JPG et JPEG sont autorisés.";
                } elseif ($fileSize > $sizeMax) {
                    $error['addImg'] = "Le fichier est trop volumineux. La taille maximale est de 2MB.";
                } else {
                    $newFileName = uniqid('exercise') . '.' . $fileExtension;
                    $destination = $uploadDir . $newFileName;
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $exerciseModel->setExerciseId($exercise_id);
                        $exerciseModel->setImage($newFileName);
                        if ($exerciseModel->addImage()) {
                            $success['addImg'] = "Image ajoutée avec succès.";
                        } else {
                            $error['addImg'] = "Erreur lors de l'ajout de l'image.";
                        }
                    } else {
                        $error['addImg'] = "Erreur lors du déplacement du fichier.";
                    }
                }
            } else {
                $error['addImg'] = "Erreur lors du transfert du fichier.";
            }
        }
} catch (\PDOException $ex) {
    echo sprintf('La récupération de l\'exercice a échoué avec le message : %s', $ex->getMessage());
}
var_dump($_POST);
$title = "Modifier l'exercice";

renderView('dashboard/exercises/update-exercise', compact('title', 'exercise', 'body_parts'));
