<?php

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $category_article_id = filter_input(INPUT_POST, 'category_article_id', FILTER_VALIDATE_INT);
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);

        if ($category_article_id && !empty($name)) {
            $categoryModel = new CategoryArticle(
                category_article_id: $category_article_id,
                category_name: $name,
            );

            if ($categoryModel->updateCategoryArticle()) {
                redirectToRoute('categories-article/list-categories-article');
                die;
            }
        }
    }
} catch (\PDOException $e) {
    echo sprintf('Erreur : %s', $e->getMessage());
}

header('Location: ?page=categories-article/list-categories-article');
exit;
