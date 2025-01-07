<?php
require_once __DIR__ . '/../../../classes/tag.php';
require_once __DIR__ . '/../../../classes/database.php';



class getTag {
    static function getAllTags(){
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $themes = Tag::getAllTags($pdo);
        return $themes;
    }
    static function getTagById($id){
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $theme = Tag::getTagById($pdo,$id);
        return $theme;
    }
}

?>