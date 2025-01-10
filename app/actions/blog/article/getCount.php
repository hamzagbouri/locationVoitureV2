<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/database.php';

        $themeId = $_GET['themeId'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $article = Article::getCountArticle($pdo,$themeId);
        echo json_encode($article);
?>