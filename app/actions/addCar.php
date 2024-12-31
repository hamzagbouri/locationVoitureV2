<?php
require_once('../classes/car.php');
require_once('../classes/database.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit']) ){
        $marque = (($_POST['marque']));
        $modele = (($_POST['modele']));
        $annee = (($_POST['annee']));
        $prix = (($_POST['prix']));
        $disponibilite = (($_POST['disponibilite']));
        $categoryId = (($_POST['category_id']));
        $carCount = $_POST['carCount'];
        echo $carCount;
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $uploadDir = 'uploads/'; 
        if (!is_dir('../'.$uploadDir)) {
            mkdir("../".$uploadDir, 0777, true); 
        }
        for ($i = 0; $i < $carCount; $i++) {
        
            if ( $_FILES['image']['error'][$i] !== UPLOAD_ERR_OK) {
                echo "Error for file $i: " . $_FILES['image']['error'][$i] . "<br>";
                continue;
            }
    
            // Validate file type and size
            $allowedTypes = ['image/jpeg', 'image/png'];
            $maxSize = 5 * 1024 * 1024; 
    
            if (!in_array($_FILES['image']['type'][$i], $allowedTypes)) {
                echo "Invalid file type for image $i.<br>";
                continue;
            }
    
            if ($_FILES['image']['size'][$i] > $maxSize) {
                echo "File size too large for image $i.<br>";
                continue;
            }
            $fileName = uniqid() . '-' . basename($_FILES['image']['name'][$i]);
            $uploadFile = $uploadDir . $fileName;
            $uploadFile2 = '../'.$uploadDir . $fileName;
    
            if (move_uploaded_file($_FILES['image']['tmp_name'][$i], $uploadFile2)) {
                $imagePath = $uploadFile; 
    
               
                $car = new Car(
                    null, 
                    $marque[$i], 
                    $modele[$i], 
                    $annee[$i], 
                    $prix[$i], 
                    $disponibilite[$i], 
                    $categoryId[$i], 
                    $imagePath
                );
    
                $responseCode = $car->createCar($pdo);
    
                if ($responseCode === 202) {
                    echo "Car $i added successfully!<br>";
                } else {
                    echo "Failed to add car $i.<br>" . $responseCode;
                }
            } else {
                echo "Failed to upload image for car $i.<br>";
            }
        }
    
        
        

        

    }
    header('Location: ../../public/admin/cars.php');
   
} else {
    header('Location: ../../public');

}

?>