<?php
require_once('../classes/category.php');
require_once('../classes/database.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit']) ){
        $nom = trim(htmlspecialchars($_POST['nom-category']));
       
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $category = new Category(null,$nom);
        $res = $category->createCategory($pdo);
        if($res == 202)
        {
            header('Location: ../../public/admin/category.php');
        }
        else {
            echo "couldn't add Category";
        }
        
        
    
        
        

        

    }
    // header('Location: ../../public/admin/category.php');
   
} else {
    header('Location: ../../public');

}

?>