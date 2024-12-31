<?php
require_once('../classes/category.php');
require_once('../classes/database.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit']) ){
        $id = trim(htmlspecialchars($_POST['id-category-edit']));
        $nom = trim(htmlspecialchars($_POST['nom-category-edit']));
       
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $category = new Category($id,$nom);
        $res = $category->modifyCategory($pdo);
        if($res == 202)
        {
            header('Location: ../../public/admin/category.php');
        }
        else {
            echo "couldn't modify Category";
        }
        
        
    
        
        

        

    }
    header('Location: ../../public/admin/category.php');
   
} else {
    header('Location: ../../public');

}

?>