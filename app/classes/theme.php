<?php
class Theme {
    private $id;
    private $nom;
    private $imagePath;

    public function __construct($id = null, $nom, $imagePath = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->imagePath = $imagePath;
    }

    public function createTheme($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Theme (nom, image_path) VALUES (?, ?)");
            $stmt->execute([$this->nom, $this->imagePath]);
            return 202;
        } catch (Exception $e) {
            return 401 . $e->getMessage();
        }
    }

    public function modifyTheme($pdo) {
        try {
            if ($this->id === null) {
                throw new Exception("Theme ID is required to modify the theme.");
            }
            $stmt = $pdo->prepare("UPDATE Theme SET nom = ?, image_path = ? WHERE id = ?");
            $stmt->execute([$this->nom, $this->imagePath, $this->id]);
            return 202;
        } catch (Exception $e) {
            return 402 . $e->getMessage();
        }
    }

    public static function deleteTheme($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM Theme WHERE id = ?");
            $stmt->execute([$id]);
            return 202;
        } catch (Exception $e) {
            return 404 . $e->getMessage();
        }
    }

    public static function getThemeById($pdo, $id) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Theme WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 404 . $e->getMessage();
        }
    }

    public static function getAllThemes($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM Theme");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 406 . $e->getMessage();
        }
    }
}
?>