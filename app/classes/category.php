<?php

class Category {
    private $id;
    private $nom;

    public function __construct($id=null, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }
    
    public function createCategory($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Category (nom) VALUES (?)");
            $stmt->execute([$this->nom]);
            return 202;
        } catch(Exception $e) {
            return 401 . $e->getMessage();
        }
    }

    public function modifyCategory($pdo) {
        try {
            if ($this->id === null) {
                throw new Exception("Category ID is required to modify the Category.");
            }
            $stmt = $pdo->prepare("UPDATE Category SET nom = ? WHERE id = ?");
            $stmt->execute([$this->nom, $this->id]);
            return 202;
        } catch(Exception $e) {
            return 402;
        }
    }
    public static function checkCategory($pdo,$id)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM car WHERE category_id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        catch (Exception $e)
        {
            return 404;
        }
    }

    public static function deleteCategory($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM Category WHERE id = ?");
            $stmt->execute([$id]);
            return 202;
        } catch(Exception $e) {
            return 404 . $e->getMessage();
        }
    }

    public static function getCategoryById($pdo, $id) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Category WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            return 404;
        }
    }

  
    

    public static function getAllCategories($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM Category");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e) {
            return 406;
        }
    }
 
}
?>


