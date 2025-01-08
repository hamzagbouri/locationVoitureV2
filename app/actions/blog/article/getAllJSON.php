<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/database.php';




      
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $articles = Article::getAllArticles($pdo);
        echo json_encode($articles);
    

    


?>