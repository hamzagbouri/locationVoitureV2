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
    public static function getAllArticlesByTheme($pdo,$themeId) {
        try {
            $stmt = $pdo->prepare("SELECT * FROM Article where theme_id = :themeId");
            $stmt->bindParam(':themeId', $themeId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return 406 . $e->getMessage();
        }
    }
    public static function getAllArticlesByThemeAndTag($pdo,$themeId,$tagId) {
        try {
            $stmt = $pdo->prepare("SELECT a.* FROM Article a INNER JOIN article_tags art ON art.article_id = a.id  WHERE a.theme_id = :themeId AND art.tag_id = :tagId;");
            $stmt->bindParam(':themeId', $themeId, PDO::PARAM_INT);
            $stmt->bindParam(':tagId', $tagId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return 406 . $e->getMessage();
        }
    }

    public function attachTag($pdo, $tagId) {
        try {
            $stmt = $pdo->prepare("INSERT INTO article_tags (article_id, tag_id) VALUES (?, ?)");
           $res = $stmt->execute([$this->id, $tagId]);
            return $res;
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

    public static function searchArticleByTitre($pdo, $titre,$themeId)
    {
    try {
        $titreWithWildcards = "%" . $titre . "%";
        
        $stmt = $pdo->prepare("SELECT * FROM article WHERE titre LIKE ? and theme_id = ?");
        $stmt->execute([$titreWithWildcards,$themeId]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        
    } catch (Exception $e) {
        return ['error' => 405, 'message' => $e->getMessage()];
    }
    }
    public static function getTagsForArticle($pdo, $articleId) {
        try {
            $stmt = $pdo->prepare("
                SELECT t.id, t.nom
                FROM tag t
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
    public function getId(){
        return $this->id;
    }
    public static function addToFavori($pdo, $articleId,$userId) {
        try {
            $stmt = $pdo->prepare("INSERT INTO favori (article_id, user_id) VALUES (:article_id,:user_id)");
            $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return 202;
        } catch (PDOException $e) {
            throw new Exception("Error retrieving tags for article: " . $e->getMessage());
        }
    }
    public static function checkFavori($pdo, $articleId,$userId) {
        try {
            $stmt = $pdo->prepare("SELECT COUNT(*) as favori FROM favori where article_id = :article_id and user_id = :user_id");
            $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error retrieving tags for article: " . $e->getMessage());
        }
    }
    public static function removeFromFavori($pdo, $articleId,$userId)
    {
        try {
            $stmt = $pdo->prepare("DELETE FROM favori where article_id = :article_id and user_id = :user_id");
            $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return 202;
        } catch (PDOException $e) {
            throw new Exception("Error deleting favori article: " . $e->getMessage());
        }
    }
    public static function totalLike($pdo,$articleId)
    {
        try {
            $stmt = $pdo->prepare("SELECT count(*) as totalFavori from favori where article_id = :article_id ");
            $stmt->bindParam(':article_id', $articleId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);;
        } catch (PDOException $e) {
            throw new Exception("Error fetching favori article: " . $e->getMessage());
        }
    }
   
    
}

?>
