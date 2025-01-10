<?php
require_once __DIR__ . '/../../../classes/commantaire.php';
require_once __DIR__ . '/../../../classes/database.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();


       
        $clientId = $_SESSION['id'];
        $articleId = $_POST['article_id'];
        $commantaire = $_POST['commantaire'];
   
        $comment = new Commantaire(null,$articleId,$clientId,$commantaire);
      
        $comment->createCommantaire($pdo);

       

        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
}
?>
<?php
// require_once __DIR__ . '/../../../classes/commantaire.php';
// require_once __DIR__ . '/../../../classes/database.php';
// session_start();
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         $dbInstance = Database::getInstance();
//         $pdo = $dbInstance->getConnection();

//         $input = file_get_contents('php://input');
//         $data = json_decode($input, true);
       
//         // $clientId = $_SESSION['id'];
//         $clientId = $data['user_id'];
//         $articleId = $data['article_id'];
//         $commantaire = $data['commantaire'];
   
//         $comment = new Commantaire(null,$articleId,$clientId,$commantaire);
      
//         $comment->createCommantaire($pdo); 

       

//         echo json_encode(['status' => 'success']);
//     } catch (Exception $e) {
//         http_response_code(500);
//         echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
//     }
// }
?>