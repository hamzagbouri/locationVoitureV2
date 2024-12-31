<?php 

require_once('../classes/car.php');
require_once('../classes/database.php');

        $idCar = $_POST['id-car'];

        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        
        $result = Car::deleteCar($pdo,$idCar);
        if($result){
            echo $result;
            header("Location: ../../public/admin/cars.php");
        }
        

        

   