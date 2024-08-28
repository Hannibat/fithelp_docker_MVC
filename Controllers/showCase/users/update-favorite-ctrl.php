<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']->user_id;
    $exercise_id = filter_input(INPUT_POST, 'exercise_id', FILTER_SANITIZE_NUMBER_INT);
    $action = filter_input(INPUT_POST, 'action', FILTER_SANITIZE_SPECIAL_CHARS);

    if (!$exercise_id || !$action) {
        $response['message'] = 'Données invalides.';
        echo json_encode($response);
        exit;
    }

    try {
    if ($action === 'add') {
        // Ajouter un favori
        $markModel = new Mark($user_id, $exercise_id);
        if ($markModel->addMark()) {
            $response['success'] = true;
            $response['message'] = 'Exercice ajouté aux favoris.';
        } else {
            var_dump("non");
            $response['message'] = 'Erreur lors de l\'ajout du favori.';
        }
    } elseif ($action === 'remove') {
        // Retirer un favori
        if (Mark::removeMark($user_id, $exercise_id)) {
            $response['success'] = true;
            $response['message'] = 'Exercice retiré des favoris.';
        } else {
            $response['message'] = 'Erreur lors de la suppression du favori.';
        }
    } else {
        $response['message'] = 'Action non valide.';
    }
} catch (Exception $e) {
    $response['message'] = 'Une erreur est survenue : ' . $e->getMessage();
}

// Retourne la réponse JSON
header('Content-Type: application/json');
echo json_encode($response);
exit;
}