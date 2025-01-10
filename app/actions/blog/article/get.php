<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/database.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $articleId = $_GET['article_id'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $article = Article::getArticleById($pdo,$articleId);
        echo json_encode($article);
    }catch (Exception $e) {

        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
  

}
?>