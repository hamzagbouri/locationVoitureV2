<?php

class Commantaire {
    private $id;
    private $articleId;
    private $userId;
    private $commantaire;

    public function __construct($id = null, $articleId = null, $userId = null, $commantaire = null) {
        $this->id = $id;
        $this->articleId = $articleId;
        $this->userId = $userId;
        $this->commantaire = $commantaire;
    }

    public function createCommantaire($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Commantaire (article_id, user_id, Commantaire) VALUES (?, ?, ?)");
            $stmt->execute([$this->articleId, $this->userId, $this->commantaire]);
            $this->id = $pdo->lastInsertId();
            return 202;
        } catch (Exception $e) {
            return 401 . $e->getMessage();
        }
    }

    public function modifyCommantaire($pdo) {
        try {
            if ($this->id === null) {
                throw new Exception("Commantaire ID is required to modify the Commantaire.");
            }
            $stmt = $pdo->prepare("UPDATE Commantaire SET Commantaire = ? WHERE id = ?");
            $stmt->execute([$this->commantaire, $this->id]);
            return 202;
        } catch (Exception $e) {
            return 402 . $e->getMessage();
        }
    }

    public static function deleteCommantaire($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM Commantaire WHERE id = ?");
            $stmt->execute([$id]);
            return 202;
        } catch (Exception $e) {
            return 404 . $e->getMessage();
        }
    }

    public static function getCommantaireById($pdo, $id) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Commantaire WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 404 . $e->getMessage();
        }
    }

    public static function getCommentairesForArticle($pdo, $articleId) {
        try {
            $stmt = $pdo->prepare("SELECT c.*, totalComments.total FROM CommantaireView c CROSS JOIN (SELECT COUNT(*) AS total  FROM CommantaireView WHERE article_id = ? ) AS totalComments WHERE c.article_id = ?   ");
            $stmt->execute([$articleId,$articleId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public static function getCommentairesByUser($pdo, $userId) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Commantaire WHERE user_id = ?");
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public static function getAllCommentaires($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM Commantaire");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 406 . $e->getMessage();
        }
    }
}

?>
