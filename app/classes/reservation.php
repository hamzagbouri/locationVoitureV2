<?php
class Reservation {
    private $id;
    private $date_reservation;
    private $date_debut;
    private $date_fin;
    private $lieu;
    private $client_id;
    private $car_id;
    private $status;

    public function __construct($id = null, $date_reservation, $date_debut, $date_fin, $lieu, $client_id, $car_id,$status = "Pending") {
        $this->id = $id;
        $this->date_reservation = $date_reservation;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->lieu = $lieu;
        $this->client_id = $client_id;
        $this->car_id = $car_id;
        $this->status=$status;
    }

    public function createReservation($pdo) {
        try {
        $stmt = $pdo->prepare("CALL AjouterReservation (?, ?, ?, ?, ?)");
        $stmt->execute([$this->date_debut, $this->date_fin, $this-> lieu, $this->client_id, $this->car_id]);
        return 202;
    } catch(Exception $e)
    {
        return $e->getMessage();
    }
    }

    public function modifyReservation($pdo) {
        try{
        if ($this->id === null) {
            throw new Exception("Reservation ID is required to modify the reservation.");
        }
        $stmt = $pdo->prepare("UPDATE Reservation SET date_reservation = ?, date_debut = ?, date_fin = ?, lieu = ?, client_id = ?, car_id = ? WHERE id = ?");
        $stmt->execute([$this->date_reservation, $this->date_debut, $this->date_fin, $this->lieu, $this->client_id, $this->car_id, $this->id]);
        return 202;
    } catch(Exception $e)
    {
        return 404;
    }
    }

    public static function deleteReservation($pdo, $id) {
        try{
        $stmt = $pdo->prepare("DELETE FROM Reservation WHERE id = ?");
        $stmt->execute([$id]);
        return 202;
    } catch(Exception $e)
    {
        return 404;
    }
    }

    public static function getReservationById($pdo, $id) { 
        try{
        $stmt = $pdo->prepare("SELECT * FROM Reservation WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
        } catch(Exception $e)
        {
            return 404;
        }
    }
    
    public static function getReservationByUserId($pdo, $id) { 
        try{
        $stmt = $pdo->prepare("SELECT * FROM Reservation WHERE client_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        } catch(Exception $e)
        {
            return 404;
        }
    }

    public static function getAllReservations($pdo) { try {

    
        $stmt = $pdo->query("SELECT * FROM Reservation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    } catch(Exception $e)
    {
        return 404;
    }
    }
    public static function verifierDisponibilte($pdo,$idCar,$date_debut,$date_fin){
        $stmt = $pdo->prepare("SELECT * FROM reservation WHERE car_id = :carId AND ((:date_debut BETWEEN date_debut AND date_fin) OR (:date_fin BETWEEN date_debut AND date_fin) OR(date_debut BETWEEN :date_debut AND :date_fin) OR (date_fin BETWEEN :date_debut AND :date_fin) )");   
        $stmt ->execute([':carId' => $idCar, ':date_debut'=>$date_debut, ':date_fin'=>$date_fin]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function updateStatus($pdo,$id,$newstatus)
    {
        try {
            $stmt = $pdo->prepare("UPDATE reservation set status = ? where id =?");   
            $stmt ->execute([$newstatus, $id]);
            return 202;
        } catch (Excpetion $e)
        {
            return $e->getMessage();
        }
    }
}
?>