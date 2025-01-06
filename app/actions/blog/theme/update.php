<?php
require_once __DIR__ . '/../../../classes/theme.php';
require_once __DIR__ . '/../../../classes/database.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit']) ){
        $nom = trim(htmlspecialchars($_POST['nom-theme-edit']));
        $id = trim(htmlspecialchars($_POST['id-theme-edit']));
        
    
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $theme = new Theme($id,$nom,null);
        $res = $theme->modifyTheme($pdo);
        if($res == 202)
        {
            header('Location: ../../../../public/admin/themes.php');
        }
        else {
            echo "couldn't Modify Theme";
        }
        
        
        }
        

    
 
   
} else {
    header('Location: ../../public');

}
?>