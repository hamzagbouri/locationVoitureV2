<?php
session_start();
require_once('../classes/reservation.php');
require_once('../classes/database.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $lieu = $_POST['lieu'];
    $car_id = $_POST['carId-select'];
    $clientId = $_SESSION['id'];
    $dbInstance = Database::getInstance();
    $pdo = $dbInstance->getConnection();
    $reservations = Reservation::verifierDisponibilte($pdo, $car_id, $date_debut, $date_fin);
    
    if(count($reservations > 0))
    {
        $lastR = end($reservations);
        $_SESSION['error'] = "this car isn't available on this date it will be available after" . $lastR['date_fin'];
        header('Location: ../../public/client/cars.php');
    }
    else{
        $reservation = new Reservation(null,null,$date_debut,$date_fin,$lieu,$clientId,$car_id);
        $result = $reservation->createReservation($pdo);
        if($result == 202)
        {
            header('Location: ../../public/client/reservation.php');
        }
        else {
            echo $result;
        }
    }

}


?>