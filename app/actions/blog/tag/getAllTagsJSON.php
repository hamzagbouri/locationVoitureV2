<?php
require_once __DIR__ . '/../../../classes/tag.php';
require_once __DIR__ . '/../../../classes/database.php';




      
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $tags = Tag::getAllTags($pdo);
        echo json_encode($tags);
    

    


?>