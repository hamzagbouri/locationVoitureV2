<?php
require_once __DIR__ . '/../../../classes/commantaire.php';
require_once __DIR__ . '/../../../classes/database.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
     
        $commantaire = $_POST['newComment'];
        $commentId = $_POST['commentId'];
   
        $comment = new Commantaire($commentId,null,null,$commantaire);
      
        $comment->modifyCommantaire($pdo);

        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>