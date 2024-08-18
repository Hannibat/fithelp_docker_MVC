<?php

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category_article_id'])) {
        $category_article_id = filter_input(INPUT_POST, 'category_article_id', FILTER_VALIDATE_INT);

        if ($category_article_id) {
            $isOk = CategoryArticle::deleteCategoryArticle($category_article_id);

            if ($isOk) {
                redirectToRoute('categories-article/list-categories-article');
                die;
            }
        }
    }
} catch (\PDOException $e) {
    echo sprintf('Erreur : %s', $e->getMessage());
}
