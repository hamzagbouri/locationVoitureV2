<?php

require_once __DIR__ . '/../classes/car.php';
require_once __DIR__ . '/../classes/database.php';

class getCar {
    static function getAllCars(){
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $cars = Car::getAllCars($pdo);
        return $cars;
    }
    static function getCarById($id){
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
     
        $car = Car::getCarById($pdo,$id);
   
        return $car;
    }
    
    

}
?>