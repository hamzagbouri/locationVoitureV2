<?php
require_once __DIR__ . '/../../../classes/tag.php';
require_once __DIR__ . '/../../../classes/database.php';




        $q = $_GET['query'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $tags = Tag::searchTag($pdo,$q);
        echo json_encode($tags);
    

    


?>