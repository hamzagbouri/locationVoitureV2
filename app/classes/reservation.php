<?php
class Reservation {
    private $id;
    private $date_reservation;
    private $date_debut;
    private $date_fin;
    private $lieu;
    private $client_id;
    private $car_id;

    public function __construct($id = null, $date_reservation, $date_debut, $date_fin, $lieu, $client_id, $car_id) {
        $this->id = $id;
        $this->date_reservation = $date_reservation;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->lieu = $lieu;
        $this->client_id = $client_id;
        $this->car_id = $car_id;
    }

    public function createReservation($pdo) {
        try {
        $stmt = $pdo->prepare("INSERT INTO Reservation (date_reservation, date_debut, date_fin, lieu, client_id, car_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$this->date_reservation, $this->date_debut, $this->date_fin, $this->lieu, $this->client_id, $this->car_id]);
        return 202;
    } catch(Exception $e)
    {
        return 404;
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

    public static function getAllReservations($pdo) { try {

    
        $stmt = $pdo->query("SELECT * FROM Reservation");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    } catch(Exception $e)
    {
        return 404;
    }
    }
}
?>