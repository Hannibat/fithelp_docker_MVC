<?php

try {
    $users = User::getAllUsers();
} catch (\PDOException $e) {
    $error['exception'] = "Erreur : " . $e->getMessage();
}

$title = "Liste des utilisateurs";

// Chargement de la vue
renderView('dashboard/users/list-users', compact('title', 'users'));
