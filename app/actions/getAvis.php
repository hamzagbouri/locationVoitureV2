
<?php
require_once __DIR__ . '/../classes/avis.php';
require_once __DIR__ . '/../classes/database.php';

class getAvis {
    static function getAvisByIdUserRes($id,$idRes){

        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $avis = Avis::getAvisByIdUserRes($pdo,$id,$idRes);

        return $avis;
    }
    static function getAllAvis()
    {
        
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $avis = Avis::getAllAvis($pdo);

        return $avis;
    }
}
?>