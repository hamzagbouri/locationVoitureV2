<?php
require_once __DIR__ . '/../classes/car.php';
require_once __DIR__ . '/../classes/database.php';

if (isset($_POST['start'])) {
    
    $start = (int)$_POST['start'];
    $dbInstance = Database::getInstance();
    $pdo = $dbInstance->getConnection();
    $cars = Car::getCustomCars($pdo, 6, $start);
    echo json_encode($cars);
} else {
    echo json_encode(['error' => 'Invalid input']);
}
?>
