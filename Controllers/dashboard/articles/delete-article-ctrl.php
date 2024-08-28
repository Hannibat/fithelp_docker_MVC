<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    try {
        // Récupération du paramètre d'URL correspondant à l'id de l'article cliqué
        $article_id = intval(filter_input(INPUT_POST, 'article_id', FILTER_SANITIZE_NUMBER_INT));
        
        if ($article_id) {
            $thisarticle = Article::getOneArticle($article_id);
            if ($thisarticle && $thisarticle->picture) {
                $base_dir = realpath($_SERVER["DOCUMENT_ROOT"]);
                $uploadDir = $base_dir . '/public/uploads/articles/';
                $oldImage = $thisarticle->picture;

                if (file_exists($uploadDir . $oldImage)) {
                    unlink($uploadDir . $oldImage);
                }
            }
            // Appel de la méthode delete exercice
            $isOk = Article::deleteArticle($article_id);
            // Si la méthode a retourné "true", alors on redirige vers la liste
            if ($isOk) {
                $_SESSION['flash_message'] = "L'exercice a été supprimé avec succès.";
                header('Location: /?page=articles/list-articles');
                exit();
            }
        }
    } catch (\PDOException $e) {
        echo sprintf('la suppression de l\'exercice a échoué avec le message %s', $e->getMessage());
    }
}
