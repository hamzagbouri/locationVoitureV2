<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/database.php';




        $id = $_GET['articleId'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $tags = Article::getTagsForArticle($pdo,$id);
        echo json_encode($tags);
    

    


?>