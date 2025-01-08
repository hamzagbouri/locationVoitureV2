<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/database.php';




        $idArticle = $_GET['articleId'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $tags = Article::getTagsForArticle($pdo,$idArticle);
        echo json_encode($tags);
    

    


?>