<?php

try {
    // Récupération des catégories d'articles
    $categories_article = CategoryArticle::getAllCategoriesArticles();

    // Si les données du formulaire ont été soumises
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Récupération et validation des champs du formulaire
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_SPECIAL_CHARS);
        $intro = filter_input(INPUT_POST, 'intro', FILTER_SANITIZE_SPECIAL_CHARS);
        $containt = filter_input(INPUT_POST, 'containt', FILTER_SANITIZE_SPECIAL_CHARS);
        $conclusion = filter_input(INPUT_POST, 'conclusion', FILTER_SANITIZE_SPECIAL_CHARS);
        $category_article_id = intval(filter_input(INPUT_POST, 'category_article_id', FILTER_VALIDATE_INT));

        // Initialisation du tableau des erreurs
        $error = [];

        // Validation des champs obligatoires
        if (!$title) {
            $error['title'] = 'Le champ est obligatoire!';
        }
        if (!$intro) {
            $error['intro'] = 'Le champ est obligatoire!';
        }
        if (!$containt) {
            $error['containt'] = 'Le champ est obligatoire!';
        }
        if (!$conclusion) {
            $error['conclusion'] = 'Le champ est obligatoire!';
        }
        if (!$category_article_id) {
            $error['category_article_id'] = 'Le champ catégorie est obligatoire!';
        }

        // Gestion du fichier image
        $picture = $_FILES['file'];
        $sizeMax = 2 * 1024 * 1024;
        $extensions = ['png', 'jpg', 'jpeg']; 
        $uploadDir = __DIR__ . '/../../../public/uploads/articles/'; 

        $fileName = basename($picture['name']);
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileSize = $picture['size'];
        $fileTmpName = $picture['tmp_name'];
        $fileError = $picture['error'];

        if ($fileError != 0) {
            $error['file'] = "Erreur lors du transfert du fichier.";
        } else {
            if (!in_array($fileExtension, $extensions)) {
                $error['file'] = "Seuls les formats PNG, JPG, JPEG sont autorisés.";
            }
            if ($fileSize > $sizeMax) {
                $error['file'] = "Le fichier dépasse la taille maximale autorisée de 2MB.";
            }

            // Si aucune erreur, on déplace l'image
            if (empty($error)) {
                $newFileName = uniqid('article') . '.' . $fileExtension;
                $destination = $uploadDir . $newFileName;
                if (move_uploaded_file($fileTmpName, $destination)) {
                    $success['file'] = "Fichier téléchargé avec succès!";
                } else {
                    $error['file'] = "Erreur lors du déplacement du fichier.";
                }
            }
        }

        // Si aucune erreur dans le formulaire, ajouter l'exercice
        if (empty($error)) {
            $articleModel = new Article(
                title: $title,
                intro: $intro,
                containt: $containt,
                conclusion: $conclusion,
                picture: $newFileName,
                category_article_id: $category_article_id
            );

            // Insertion en base de données
            if ($articleModel->addArticle()) {
                header('Location: /?page=articles/list-articles');
                exit();
            } else {
                $error['name'] = "Erreur lors de l'ajout de l'article.";
            }
        }
    }
} catch (\PDOException $e) {
    echo sprintf('Erreur lors de l\'ajout de l\'article : %s', $e->getMessage());
}

$title = "Ajouter un article";

renderView('dashboard/articles/add-article', compact('title','categories_article'));