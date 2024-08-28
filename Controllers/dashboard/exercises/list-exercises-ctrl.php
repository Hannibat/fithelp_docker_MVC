<?php
try {
    $user = $_SESSION['user'];
    $user_id = $user->user_id;

    // Récupération des données
    $body_parts = BodyPart::getAllBodyParts();

    // Récupérez les paramètres du formulaire
    $categoryFilter = isset($_GET['body_part_id']) ? (int)$_GET['body_part_id'] : null;
    $searchTerm = isset($_GET['search']) ? $_GET['search'] : null;

    // Appelez la méthode avec les paramètres
    $exercises = Exercise::getAllExercises($categoryFilter, $searchTerm, $user_id);

} catch (\PDOException $e) {
    echo sprintf('La récupération des exercices a échoué avec le message : %s', $e->getMessage());
    die();
}

// Set page title
$title = "Liste des exercices";

// Render the view with the data
renderView('dashboard/exercises/list-exercises', compact('title', 'exercises', 'body_parts', 'user'));
