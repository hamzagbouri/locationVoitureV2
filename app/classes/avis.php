<?php
class Avis {
    private $id;
    private $message;
    private $stars;
    private $reservation_id;
    private $archive = false;

    public function __construct($id = null, $message, $stars, $reservation_id) {
        $this->id = $id;
        $this->message = $message;
        $this->stars = $stars;
        $this->reservation_id = $reservation_id;
    }

    public function createAvis($pdo) {
        try {
            $query = "INSERT INTO avis (avis, stars, reservation_id, archive) 
                      VALUES (:message, :stars, :reservation_id, :archive)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':message', $this->message);
            $stmt->bindParam(':stars', $this->stars);
            $stmt->bindParam(':reservation_id', $this->reservation_id);
            $stmt->bindParam(':archive', $this->archive, PDO::PARAM_BOOL);
            
            if ($stmt->execute()) {
                return 202;
            } else {
                return "Failed to create review.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public function modifyAvis($pdo) {
        try {
            $query = "UPDATE avis SET avis = :message, stars = :stars
                      WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':message', $this->message);
            $stmt->bindParam(':stars', $this->stars);
            
            if ($stmt->execute()) {
                return 202;
            } else {
                return "Failed to update review.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public static function deleteAvis($pdo, $id) {
        try {
            $query = "DELETE FROM avis WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                return "Review deleted successfully.";
            } else {
                return "Failed to delete review.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }


    public static function getAvisById($pdo, $id) {
        try {
            $query = "SELECT * FROM avis WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                return "Review not found.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public static function getAvisByIdUserRes($pdo, $idC,$resId) {
        try {
            $query = "SELECT a.* FROM avis a INNER JOIN reservation r on a.reservation_id = r.id Where  r.client_id = :id and a.reservation_id = :resid ";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['id'=>$idC,'resid'=>$resId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
          
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public static function getAvisByCar($pdo, $id) {
        try {
            $query = "SELECT a.* FROM avis a inner join reservation r on a.reservation_id = r.id WHERE r.car_id = :id and a.archive = 0";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($result) {
                return $result;
            } else {
                return "Review not found.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    public static function getAllAvis($pdo) {
        try {
            $query = "SELECT * FROM avis";
            $stmt = $pdo->query($query);
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if ($reviews) {
                return $reviews;
            } else {
                return "No reviews found.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
    public static function archiveAvis($pdo,$id,$value){
        try {
        $stmt = $pdo->prepare("UPDATE avis set archive = ? where id =?");
        $stmt->execute([$value,$id]);
        return 202;}
        catch (Exception $e)
        {
            return 404 . $e->getMessage();
        }
    }

}
?>
