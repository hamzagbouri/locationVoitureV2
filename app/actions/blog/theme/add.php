<?php
require_once __DIR__ . '/../../../classes/theme.php';
require_once __DIR__ . '/../../../classes/database.php';
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit']) ){
        $nom = trim(htmlspecialchars($_POST['nom-theme']));
        
        if ( $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            echo "Error for file $i: " . $_FILES['image']['error'] . "<br>";
   
        }
        $uploadDir = 'uploads/'; 
        $fileName = uniqid() . '-' . basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $fileName;
        $uploadFile2 = '../../../'.$uploadDir . $fileName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile2)) {
        $imagePath = $uploadFile; 
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $theme = new Theme(null,$nom,$imagePath);
        $res = $theme->createTheme($pdo);
        if($res == 202)
        {
            header('Location: ../../../../public/admin/themes.php');
        }
        else {
            echo "couldn't add Theme";
        }
        
        
        }
        
        

        

    }
    // header('Location: ../../public/admin/category.php');
   
} else {
    header('Location: ../../public');

}
?>