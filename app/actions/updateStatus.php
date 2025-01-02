<?php
require_once __DIR__ . '/../classes/reservation.php';
require_once __DIR__ . '/../classes/database.php';
if($_SERVER['REQUEST_METHOD'] == 'POST' ){
    if(isset($_POST['action'])) {
        $reservationId = $_POST['res-id'];
        $newStatus = $_POST['new-status'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $res = Reservation::updateStatus($pdo,$reservationId,$newStatus);
        if($res == 202)
        {
            header('Location: ../../public/client/reservation.php');
        } else {
            echo $res;
        }
       
        

    } else{
        echo 'aa';
    }
}
?>