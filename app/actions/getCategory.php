<?php

require_once __DIR__ . '/../classes/category.php';
require_once __DIR__ . '/../classes/database.php';

class getCategory {
    static function getAllCategories(){
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $categories = Category::getAllCategories($pdo);
        return $categories;
    }
}
?>