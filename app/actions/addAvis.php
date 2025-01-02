<?php
require_once('../classes/avis.php');
require_once('../classes/database.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit']) ){
        $message = trim(htmlspecialchars($_POST['message']));
        $stars = trim(htmlspecialchars($_POST['stars']));
        $reservationId = trim(htmlspecialchars($_POST['reservation_id']));
       
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $avis = new Avis(null,$message,$stars,$reservationId);
        $res = $avis->createAvis($pdo);
        if($res == 202)
        {
            header('Location: ../../public/client/reservation.php');
        }
        else {
            echo $res;
        }
        
        
    
        
        

        

    }
    // header('Location: ../../public/admin/category.php');
   
} else {
    header('Location: ../../public');

}

?>