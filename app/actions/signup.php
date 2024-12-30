<?php 

require_once('../classes/client.php');
require_once('../classes/database.php');

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST['submit']) ){

        $email = trim(htmlspecialchars( $_POST['email-signup']));
        $password = trim(htmlspecialchars($_POST['password-signup']));
        $fullName = trim(htmlspecialchars($_POST['fullName-signup']));
        if(empty($email) or empty($password)){
            echo "data is empty";
            return;
        }
        $dbInstance = Database::getInstance();
        $pdo = $dbInstance->getConnection();

        $user1 = new Client(null,$email,$fullName,$password,'client');
        echo $user1;
        $res = $user1->register($pdo);
     
        if($res)
        {

            header("Location: ../../public");

        }
        else
        {
            $_SESSION['error']="User with this email already exists";
            header("Location: ../../public/signup.php");
        }

        

    }else{
        echo "Please enter any data";
    }
}
?>