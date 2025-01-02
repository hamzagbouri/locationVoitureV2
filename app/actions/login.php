<?php 

require_once('../classes/User.php');
require_once('../classes/database.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['email-login']) && isset($_POST['password-login'])){
        $email = trim($_POST['email-login']);
        $password = trim($_POST['password-login']);
        if(empty($email) or empty($password)){
            echo "data is empty";
            return;
        }
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();
        $user = new User(null,$email, '', $password, ""); 
        $result = $user->login($pdo);
   
        if($result == 202){
        
            if( $_SESSION['user_role'] == "admin" ){
            header("Location: ../../public/admin/index.php");
            }else{
                header("Location: ../../public/client/home.php");
            }

        
        }else if($result == 404) {
            $_SESSION['error'] = 'This User is banned!!';
            header('Location: ../../public');
        }
        else {
            echo "Invalid User name or Password";
        }
        

        

    }else{
        header('Location: ../../public');
    }
   
}