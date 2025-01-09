<?php
require_once __DIR__ . '/../../../classes/article.php';
require_once __DIR__ . '/../../../classes/database.php';




if (isset($_GET['themeId'])) {
        $themeId = trim($_GET['themeId']);
        $tagId = isset($_GET['tagId']) ? trim($_GET['tagId']) : null;
    
        try {
            $dbInstance = Database::getInstance();
            $pdo = $dbInstance->getConnection();
    
            if ($tagId) {
                $articles = Article::getAllArticlesByThemeAndTag($pdo, $themeId, $tagId);
            } else {
                $articles = Article::getAllArticlesByTheme($pdo, $themeId);
            }
    
            echo json_encode($articles);
        } catch (Exception $e) {
            echo json_encode(['error' => $e->getMessage()]);
        }
    } else {
        // Si themeId est manquant
        echo json_encode(['error' => 'Parameter themeId is required.']);
    }
    
        
    

    


?>