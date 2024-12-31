<?php
class Car {
    private $id;
    private $marque;
    private $modele;
    private $annee;
    private $prix;
    private $disponibilite;
    private $category_id;
    private $image_path; 

    public function __construct($id = null, $marque, $modele, $annee, $prix, $disponibilite, $category_id, $image_path = null) {
        $this->id = $id;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->annee = $annee;
        $this->prix = $prix;
        $this->disponibilite = $disponibilite;
        $this->category_id = 1;
        $this->image_path = $image_path; 
    }

    public function createCar($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Car (marque, modele, annee, prix, disponibilite, category_id, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$this->marque, $this->modele, $this->annee, $this->prix, $this->disponibilite, $this->category_id, $this->image_path]);
            return 202;
        } catch(Exception $e) {
            return 401 . $e->getMessage();
        }
    }

    public function modifyCar($pdo) {
        try {
            if ($this->id === null) {
                throw new Exception("Car ID is required to modify the car.");
            }
            $stmt = $pdo->prepare("UPDATE Car SET marque = ?, modele = ?, annee = ?, prix = ?, disponibilite = ?, category_id = ?, image_path = ? WHERE id = ?");
            $stmt->execute([$this->marque, $this->modele, $this->annee, $this->prix, $this->disponibilite, $this->category_id, $this->image_path, $this->id]);
            return 202;
        } catch(Exception $e) {
            return 402;
        }
    }

    public static function deleteCar($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM Car WHERE id = ?");
            $stmt->execute([$id]);
            return 202;
        } catch(Exception $e) {
            return 403;
        }
    }

    public static function getCarById($pdo, $id) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Car WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            return 404;
        }
    }

    public static function getCarByCategory($pdo, $idCategory) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Car WHERE category_id = ?");
            $stmt->execute([$idCategory]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            return 405;
        }
    }

    public static function getAllCars($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM Car");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            return 406;
        }
    }
}
?>
