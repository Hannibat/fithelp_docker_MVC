<?php

$categories_articles = CategoryArticle::getAllCategoriesArticles();
$user = $_SESSION['user'];
$article_id = isset($_GET['article_id']) ? (int)$_GET['article_id'] : null;

if (is_null($article_id)) {
    header("Location: ?page=articles/list-articles");
    exit();
}

try {
    $article = Article::getOneArticle($article_id);

    if (!$article) {
    }

} catch (\PDOException $e) {
    // Gestion des erreurs lors de la récupération de l'article
    echo sprintf('La récupération de l\'article a échoué avec le message : %s', $e->getMessage());
    exit();
}

renderView('showcase/users/detail-article', compact('article', 'categories_articles','user'));

?>
