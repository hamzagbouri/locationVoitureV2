
<?php
require_once __DIR__ . '/../classes/User.php';
require_once __DIR__ . '/../classes/database.php';

class getUser {
    static function getUserById($id){

        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $user = User::getUserById($pdo,$id);

        return $user;
    }
  
}
?>