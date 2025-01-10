<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/database.php';




if (isset($_GET['themeId'])) {
        $themeId = trim($_GET['themeId']);
        $startIndex = isset($_GET['start']) ? trim($_GET['start']) : null;
        $limit = isset($_GET['limit']) ? trim($_GET['limit']) : null;
    
        try {
            $dbInstance = Database::getInstance();
            $pdo = $dbInstance->getConnection();
    
            $articles = Article::getCustomArticles($pdo,$themeId,$limit,$startIndex);

    
            echo json_encode($articles);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {

        echo json_encode(['error' => 'Parameter themeId is required.']);
    }
    
        
    

    


?>