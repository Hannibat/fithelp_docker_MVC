<?php

try {
    // Si les données du formulaire ont été transmises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $error = [];

        // Récupération, nettoyage et validation des données
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        if (!$name) {
            $error['name'] = 'Ce champ est obligatoire!';
        }
        // Instance du modèle
        $categoryModel = new CategoryArticle(category_name: $name);

        // Si pas d'erreur, procéder à l'ajout
        if (empty($error)) {
            // Ajout de la catégorie
            if ($name = $categoryModel->addCategoryArticle()) {
                header('Location: /?page=categories-article/list-categories-article');
                exit();
            } else {
                echo "Erreur lors de l'ajout de la catégorie.";
            }
        }
    }

} catch (\PDOException $e) {
    echo sprintf('Erreur dans l\'ajout de catégorie : %s', $e->getMessage());
}

$title = "Ajouter une catégorie pour les articles";

renderView('dashboard/categories-article/add-category-article', compact('title'));