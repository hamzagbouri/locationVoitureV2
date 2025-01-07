<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/tag.php';
require_once __DIR__ . '/../../../classes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();


        $uploadDir = 'uploads/';
        $fileName = uniqid() . '-' . basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $fileName;
        $uploadFile2 = '../../../' . $uploadDir . $fileName;

        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile2)) {
                throw new Exception("Failed to upload image");
            }
        } else {
            throw new Exception("Error uploading image: " . $_FILES['image']['error']);
        }
        $themeId = $_POST['themeId'];
        $titre = $_POST['title'];
        $description = $_POST['description'];
        $article = new Article(null,$uploadFile,$titre,$description,$themeId);
      
        $article->createArticle($pdo); 

        $selectedTags = json_decode($_POST['selectedTags'], true);
        if ($selectedTags) {
            foreach ($selectedTags as $tag) {
                if (strpos($tag['id'], 'new') === 0) {
                    $nom = htmlspecialchars($tag['nom']);
                    $newTag = new Tag(null,$nom);
              
                    $result = $newTag->createTag($pdo); 
                    $tagId=$newTag->getId();
                } else {
                    $tagId = $tag['id'];
                }

                $article->attachTag($pdo, $tagId);
            }
        }

        echo json_encode(['status' => 'success', 'articleId' => $articleId]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
