<?php
require_once __DIR__ . '/../../../classes/commantaire.php';

require_once __DIR__ . '/../../../classes/database.php';

if($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['articleId']))
{       
        $articleId = $_GET['articleId'];
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $commantaires = Commantaire::getCommentairesForArticle($pdo,$articleId);
        echo json_encode($commantaires);
}

?>