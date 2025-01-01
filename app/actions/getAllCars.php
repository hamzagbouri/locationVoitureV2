<?php

require_once __DIR__ . '/../classes/car.php';
require_once __DIR__ . '/../classes/database.php';

        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $cars = Car::getAllCars($pdo);
        echo json_encode($cars);
?>