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
        
        Article::addToFavori($pdo,$articleId,$user_id);
        echo json_encode(['status' => 'success']);
    } else if (isset($_GET['checkId'])) {
        $articleIed = $_GET['checkId'];
        $res = Article::checkFavori($pdo,$articleIed,$user_id);
        echo json_encode($res); 
} else if (isset($_GET['totalFavori'])) {
    $articleIed = $_GET['totalFavori'];
    $res = Article::totalLike($pdo,$articleIed);
    echo json_encode($res); 
} 
}catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
}
?>