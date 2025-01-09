<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/database.php';
if($_SERVER['REQUEST_METHOD'] ==  'GET')
{
        $themeId = trim($_GET['themeId']);
        $titre = trim($_GET['titre']);
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $articles = Article::searchArticleByTitre($pdo,$themeId,$titre);
        echo json_encode($articles);
}
?>