<?php

try {
    // Récupération de l'utilisateur
    $user = $_SESSION['user'];
} catch (\PDOException $e) {
    echo sprintf('La récupération de l\'utilisateur a échoué avec le message %s', $e->getMessage());
    exit;
}

$title = "Profil";

renderView('showCase/profil', compact('title', 'user'));

