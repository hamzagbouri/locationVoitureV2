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

    // Create a new review
    public function createAvis($pdo) {
        try {
            $query = "INSERT INTO avis (message, stars, reservation_id, archive) 
                      VALUES (:message, :stars, :reservation_id, :archive)";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':message', $this->message);
            $stmt->bindParam(':stars', $this->stars);
            $stmt->bindParam(':reservation_id', $this->reservation_id);
            $stmt->bindParam(':archive', $this->archive, PDO::PARAM_BOOL);
            
            if ($stmt->execute()) {
                return "Review created successfully.";
            } else {
                return "Failed to create review.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Modify an existing review
    public function modifyAvis($pdo) {
        try {
            $query = "UPDATE avis SET message = :message, stars = :stars, reservation_id = :reservation_id, archive = :archive 
                      WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':message', $this->message);
            $stmt->bindParam(':stars', $this->stars);
            $stmt->bindParam(':reservation_id', $this->reservation_id);
            $stmt->bindParam(':archive', $this->archive, PDO::PARAM_BOOL);
            
            if ($stmt->execute()) {
                return "Review updated successfully.";
            } else {
                return "Failed to update review.";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // Delete a review by ID
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

    // Get a review by ID
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

    // Get all reviews
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
}
?>
