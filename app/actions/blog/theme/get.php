<?php
require_once __DIR__ . '/../../../classes/theme.php';
require_once __DIR__ . '/../../../classes/database.php';



class getTheme {
    static function getAllTheme(){
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $themes = Theme::getAllThemes($pdo);
        return $themes;
    }
}

?>