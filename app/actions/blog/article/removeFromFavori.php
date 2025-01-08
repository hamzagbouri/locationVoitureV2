<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/tag.php';
require_once __DIR__ . '/../../../classes/database.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET' ) {
    $dbInstance = Database::getInstance();
    $pdo = $dbInstance->getConnection();
    $user_id = $_SESSION['id'];

    try {
     if(isset($_GET['articleId'])){
        $articleId = $_GET['articleId'];
        
        Article::removeFromFavori($pdo,$articleId,$user_id);
        echo json_encode(['status' => 'success']);
    } 
}catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
}
?>