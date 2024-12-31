<?php
require_once('../classes/car.php');
require_once('../classes/database.php');



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $carId = $_POST['id'];
        $marque = $_POST['marque'];
        $modele = $_POST['modele'];
        $annee = $_POST['annee'];
        $prix = $_POST['prix'];
        $disponibilite = $_POST['disponibilite'];
        $category_id = $_POST['category_id'];
    

        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();

        $carDetails = Car::getCarById($pdo, $carId);
        $imagePath = $carDetails['image_path']; 

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = 'uploads/';
            if (!is_dir('../' . $uploadDir)) {
                mkdir('../' . $uploadDir, 0777, true);
            }

       
          
          
                $fileName = uniqid() . '-' . basename($_FILES['image']['name']);
                $uploadFile = $uploadDir . $fileName;
                $uploadFile2 = '../' . $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile2)) {
                    $imagePath = $uploadFile; 
                } else {
                    echo "Failed to upload image.";
                }
           
        }

       
        $car = new Car($carId, $marque, $modele, $annee, $prix, $disponibilite, $category_id, $imagePath);
        $responseCode = $car->modifyCar($pdo);

        if ($responseCode === 202) {
            echo "Car updated successfully!";
            header('Location: ../../public/admin/cars.php');
            exit;
        } else {
            echo "Failed to update car.";
        }
    }

?>