<?php
require_once __DIR__ . '/../classes/car.php';
require_once __DIR__ . '/../classes/database.php';
if($_SERVER['REQUEST_METHOD'] ==  'POST')
{

    $modele = $_POST['modele'];
    $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $cars = Car::searchCarByModele($pdo,$modele);
        echo json_encode($cars);
}
?>