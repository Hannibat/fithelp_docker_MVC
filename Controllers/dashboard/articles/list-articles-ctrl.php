<?php


try {
    $user = $_SESSION['user'];

    // Récupération des données
    $categories_articles = CategoryArticle::getAllCategoriesArticles();
    $articles = Article::getAllArticles();
    
} catch (\PDOException $e) {
    echo sprintf('la récupération des articles a échoué avec le message %s', $e->getMessage());
    die;
}

$title = "Liste des articles";

renderView('dashboard/articles/list-articles', compact('title', 'articles', 'categories_articles', 'user'));
