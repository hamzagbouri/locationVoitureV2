<?php
require_once __DIR__ . '/../../../classes/tag.php';
require_once __DIR__ . '/../../../classes/database.php';




        $id = $_GET['id'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $tags = Tag::getTagById($pdo,$id);
        echo json_encode($tags);
    

    


?>