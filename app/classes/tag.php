<?php
class Tag {
    private $id;
    private $nom;


    public function __construct($id = null, $nom) {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function createTag($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Tag (nom) VALUES (?)");
            $stmt->execute([$this->nom]);
            $this->id = $pdo->lastInsertId();
            return 202;
        } catch (Exception $e) {
            return 401 . $e->getMessage();
        }
    }

    public function modifyTag($pdo) {
        try {
            if ($this->id === null) {
                throw new Exception("Tag ID is required to modify the Tag.");
            }
            $stmt = $pdo->prepare("UPDATE Tag SET nom = ? WHERE id = ?");
            $stmt->execute([$this->nom, $this->id]);
            return 202;
        } catch (Exception $e) {
            return 402 . $e->getMessage();
        }
    }

    public static function deleteTag($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM Tag WHERE id = ?");
            $stmt->execute([$id]);
            return 202;
        } catch (Exception $e) {
            return 404 . $e->getMessage();
        }
    }
    public function getId(){
        return $this->id;
    }
    public static function getTagById($pdo, $id) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Tag WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 404 . $e->getMessage();
        }
    }

    public static function getAllTags($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM Tag");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 406 . $e->getMessage();
        }
    }
    public static function searchTag($pdo,$search)
    {
        $sql = "SELECT * FROM Tag WHERE nom LIKE :query LIMIT 10";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['query' => '%' . $search . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>