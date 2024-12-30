<?php
require 'database.php';
require 'user.php';


class Client extends User {
    

    public function __construct($id, $email, $fullName, $password, $role) {
        parent::__construct($id,$email,$fullName,$password,$role);
    }
    public function __tostring(){
        return $this->role . "aa";
    }
    public function register($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email ");
        $stmt->execute(['email' => $this->email]);
        $user = $stmt->fetch();
        
        if ($user) {
            return false;
        }
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO user (fullName, password, email, role) VALUES (:fullName, :password, :email, :role)");

        $stmt->execute([
            ':fullName' => $this->fullName,
            ':password' => $hashedPassword,
            ':email' => $this->email,
            ':role' => $this->role
        ]);     

        return "User registered successfully";
    }


}
?>