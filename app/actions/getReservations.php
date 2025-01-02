<?php

require_once __DIR__ . '/../classes/reservation.php';
require_once __DIR__ . '/../classes/database.php';

class getReservations {
    static function getAllReservations(){
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $reservations = Reservation::getAllReservations($pdo);
        return $reservations;
    }
    static function getReservationById($id){
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
     
        $reservation = Reservation::getReservationById($pdo,$id);
   
        return $reservation;
    }
    static function getReservationByUserId($id)
    {
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
     
        $reservation = Reservation::getReservationByUserId($pdo,$id);
   
        return $reservation;
    }
    
    

}
?>