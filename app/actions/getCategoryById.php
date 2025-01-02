<?php

require_once __DIR__ . '/../classes/category.php';
require_once __DIR__ . '/../classes/database.php';
        $id = $_POST['idCategory'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $categories = Category::getCategoryById($pdo,$id);
        echo json_encode($categories);
?>