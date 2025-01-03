<?php
require_once __DIR__ . '/../classes/car.php';
require_once __DIR__ . '/../classes/database.php';
if($_SERVER['REQUEST_METHOD'] ==  'POST')
{
    
    $idCategory = $_POST['idCategory'];
    $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $cars = Car::getCarByCategory($pdo,$idCategory);
        echo json_encode($cars);
}
?>