<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['exercise_id'])) {

    try {
        // Récupération du paramètre d'URL correspondant à l'id de l'exercice cliquée
        $exercise_id = intval(filter_input(INPUT_GET, 'exercise_id', FILTER_SANITIZE_NUMBER_INT));
        
        if ($exercise_id) {
            $thisExercise = Exercise::getOneExercise($exercise_id);
            if ($thisExercise && $thisExercise->image) {
                $base_dir = realpath($_SERVER["DOCUMENT_ROOT"]);
                $uploadDir = $base_dir . '/public/uploads/exercises/';
                $oldImage = $thisExercise->image;

                if (file_exists($uploadDir . $oldImage)) {
                    unlink($uploadDir . $oldImage);
                }
            }
            // Appel de la méthode delete exercice
            $isOk = Exercise::deleteExercise($exercise_id);

            // Si la méthode a retourné "true", alors on redirige vers la liste
            if ($isOk) {
                redirectToRoute('exercises/list-exercises');
                die;
                //     if ($exerciseModel->deleteExercise()) {
                //         $success['delete'] = "Exercice supprimé avec succès!";
                //         redirectToRoute('/exercises/list-exercises');
                //     } else {
                //         $error['delete'] = "Erreur lors de la suppression de l'exercice.";
                //     }
                // } else {
                //     $error['delete'] = "Données invalides pour la suppression de l'exercice.";
                // }
            }
        }
    } catch (\PDOException $e) {
        echo sprintf('la suppression de l\'exercice a échoué avec le message %s', $e->getMessage());
    }
}
