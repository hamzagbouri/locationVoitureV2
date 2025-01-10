<?php
require_once __DIR__ . '/../../../classes/commantaire.php';
require_once __DIR__ . '/../../../classes/database.php';
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    try {
    $idComment = $_GET['deleteId'];

    $dbInstance = Database::getInstance();
    $pdo = $dbInstance->getConnection();
    
    $result = Commantaire::deleteCommantaire($pdo,$idComment);
    echo json_encode(['status' => 'success']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
}


?>