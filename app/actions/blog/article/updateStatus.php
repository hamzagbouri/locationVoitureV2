<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/database.php';

if($_SERVER['REQUEST_METHOD']== 'POST')
{
    try {
    $articleId = $_POST['articleId'];
    $newStatus = $_POST['newStatus'];
    $dbInstance = Database::getInstance();
    $pdo = $dbInstance->getConnection();
    $res = Article::updateStatus($pdo,$articleId,$newStatus);
    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
}

?>