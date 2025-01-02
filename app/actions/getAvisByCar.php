<?php

require_once __DIR__ . '/../classes/avis.php';
require_once __DIR__ . '/../classes/database.php';

        $carId = $_POST['carId'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $avis = Avis::getAvisByCar($pdo,$carId);
        echo json_encode($avis);
?>