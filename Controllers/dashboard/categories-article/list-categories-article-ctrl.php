<?php

try {
    $categories_article = CategoryArticle::getAllCategoriesArticles();
} catch (\PDOException $e) {
    $error['exception'] = "Erreur : " . $e->getMessage();
}

$title = "Liste des catégories";

// Chargement de la vue
renderView('dashboard/categories-article/list-categories-article', compact('title', 'categories_article'));
