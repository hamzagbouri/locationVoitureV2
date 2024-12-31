<?php 
session_start();
require_once('../classes/category.php');
require_once('../classes/database.php');

        $idC = $_GET['id'];

        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        
        $result = Category::checkCategory($pdo,$idC);

        
        if($result){
          $_SESSION['error'] = "couldn't delete category, delete cars first!";
            
        } else {
            $de = Category::deleteCategory($pdo,$idC);
            if($de)
            $_SESSION['succe'] = "Category Deleted!";
        }
        header("Location: ../../public/admin/category.php");
        

        ?>

   