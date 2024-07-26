<?php


try {
    $bodyPartModel = new BodyPart();
    $body_parts = $bodyPartModel->getAllBodyParts();
    // Si les données du formulaire ont été transmises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupération, nettoyage et validation des données
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $intro = filter_input(INPUT_POST, 'intro', FILTER_SANITIZE_SPECIAL_CHARS);
        $position = filter_input(INPUT_POST, 'position', FILTER_SANITIZE_SPECIAL_CHARS);
        $movement = filter_input(INPUT_POST, 'movement', FILTER_SANITIZE_SPECIAL_CHARS);
        $targeted_muscles = filter_input(INPUT_POST, 'targeted_muscles', FILTER_SANITIZE_SPECIAL_CHARS);
        $body_part_id = intval(filter_input(INPUT_POST, 'body_part_id', FILTER_SANITIZE_NUMBER_INT));

        $error = [];

        if (!$title) {
            $error['title'] = 'Ce champ est obligatoire!';
        }
        if (!$intro) {
            $error['intro'] = 'Ce champ est obligatoire!';
        }
        if (!$position) {
            $error['position'] = 'Ce champ est obligatoire!';
        }
        if (!$movement) {
            $error['movement'] = 'Ce champ est obligatoire!';
        }
        if (!$targeted_muscles) {
            $error['targeted_muscles'] = 'Ce champ est obligatoire!';
        }
        if (!$body_part_id) {
            $error['body_part_id'] = 'Ce champ est obligatoire!';
        }

        // Si pas d'erreur, procéder à l'ajout
        $picture = $_FILES['file'];
        // Configuration des contraintes de téléchargement
        $sizeMax = 2 * 1024 * 1024; // 2 MB
        $extensions = ['png', 'jpg', 'jpeg', 'gif'];
        $uploadDir = __DIR__ . '/../../../public/uploads/exercises/';

        // Récupération des informations du fichier
        $fileName = basename($picture['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileSize = $picture['size'];
        $fileTmpName = $picture['tmp_name'];
        $fileError = $picture['error'];

        // Validation des erreurs de transfert
        if ($fileError != 0) {
            $error['file'] = "Erreur lors du transfert du fichier.";
        } else {
            // Validation de l'extension du fichier
            if (!in_array($fileExtension, $extensions)) {
                $error['file'] = "Format de fichier non autorisé. Seuls les formats PNG, JPG et JPEG sont autorisés.";
            }

            // Validation de la taille du fichier
            if ($fileSize > $sizeMax) {
                $error['file'] = "Le fichier est trop volumineux. La taille maximale est de 2MB.";
            }

            // Si pas d'erreur, déplacer le fichier téléchargé
            if (empty($error)) {
                $newFileName = uniqid('exercise') . '.' . $fileExtension;
                $destination = $uploadDir . $newFileName;
                if (move_uploaded_file($fileTmpName, $destination)) {
                    $success['file'] = "Fichier téléchargé avec succès!";
                } else {
                    $error['file'] = "Erreur lors du déplacement du fichier.";
                }
            }
        }

        // Si pas d'erreur, procéder à l'ajout de l'exercise
        if (empty($error)) {
            // Instance du modèle
            $exerciseModel = new Exercise(
                title: $title,
                intro: $intro,
                position: $position,
                movement: $movement,
                image: $newFileName,
                targeted_muscles: $targeted_muscles,
                body_part_id: $body_part_id
            );

            if ($exerciseModel->addExercise()) {
                header('Location: /?page=exercises/list-exercises');
                exit();
            } else {
                $error['name'] = "Erreur lors de l'ajout de l'exercise.";
            }
        }
    }
} catch (\PDOException $e) {
    echo sprintf('Erreur dans l\'ajout de l\'exercise : %s', $e->getMessage());
}


$title = "Ajouter un exercise";

renderView('dashboard/exercises/add-exercise', compact('title','body_parts'));