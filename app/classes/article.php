<?php

class Article {
    private $id;
    private $imagePath;
    private $titre;
    private $description;
    private $status;
    private $themeId;

    public function __construct($id = null, $imagePath = null, $titre = null, $description = null,  $themeId = null) {
        $this->id = $id;
        $this->imagePath = $imagePath;
        $this->titre = $titre;
        $this->description = $description;
        $this->themeId = $themeId;
    }

    public function createArticle($pdo) {
        try {
            $stmt = $pdo->prepare("INSERT INTO Article (image_path, titre, description, theme_id) VALUES (?, ?,  ?, ?)");
            $stmt->execute([$this->imagePath, $this->titre, $this->description, $this->themeId]);
            $this->id = $pdo->lastInsertId();
            return 202;
        } catch (Exception $e) {
            return 401 . $e->getMessage();
        }
    }

    public function modifyArticle($pdo) {
        try {
            if ($this->id === null) {
                throw new Exception("Article ID is required to modify the Article.");
            }
            $stmt = $pdo->prepare("UPDATE Article SET image_path = ?, titre = ?, description = ?, status = ?, theme_id = ? WHERE id = ?");
            $stmt->execute([$this->imagePath, $this->titre, $this->description, $this->status, $this->themeId, $this->id]);
            return 202;
        } catch (Exception $e) {
            return 402 . $e->getMessage();
        }
    }

    public static function deleteArticle($pdo, $id) {
        try {
            $stmt = $pdo->prepare("DELETE FROM article_tags WHERE article_id = ?");
            $stmt->execute([$id]);

            $stmt = $pdo->prepare("DELETE FROM Article WHERE id = ?");
            $stmt->execute([$id]);
            return 202;
        } catch (Exception $e) {
            return 404 . $e->getMessage();
        }
    }

    public static function getArticleById($pdo, $id) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Article WHERE id = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 404 . $e->getMessage();
        }
    }

    public static function getAllArticles($pdo) {
        try {
            $stmt = $pdo->query("SELECT * FROM Article");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return 406 . $e->getMessage();
        }
    }

    public function attachTag($pdo, $tagId) {
        try {
            $stmt = $pdo->prepare("INSERT INTO article_tags (article_id, tag_id) VALUES (?, ?)");
            $stmt->execute([$this->id, $tagId]);
            return 202;
        } catch (Exception $e) {
            return 401 . $e->getMessage();
        }
    }

    public function detachTag($pdo, $tagId) {
        try {
            $stmt = $pdo->prepare("DELETE FROM article_tags WHERE article_id = ? AND tag_id = ?");
            $stmt->execute([$this->id, $tagId]);
            return 202;
        } catch (Exception $e) {
            return 401 . $e->getMessage();
        }
    }


    public static function getTagsForArticle($pdo, $articleId) {
        try {
            $stmt = $pdo->prepare("
                SELECT t.id, t.name
                FROM tags t
                INNER JOIN article_tags at ON t.id = at.tag_id
                WHERE at.article_id = :articleId
            ");
            $stmt->bindParam(':articleId', $articleId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error retrieving tags for article: " . $e->getMessage());
        }
    }
    
}

?>
