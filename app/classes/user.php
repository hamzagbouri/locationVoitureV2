<?php
session_start();
class User {
    
    protected $id;
    protected $email;
    protected $fullName;
    protected $password;
    protected $role;

    public function __construct($id, $email, $fullName, $password, $role) {
        $this->id = $id;
        $this->email = $email;
        $this->fullName = $fullName;
        $this->password = $password;
        $this->role = $role;
    }
    public function login($pdo) {
        $stmt = $pdo->prepare("SELECT * FROM user WHERE email = :email ");
        $stmt->execute(['email' => $this->email]);
        $user = $stmt->fetch();

        if ($user && password_verify($this->password, $user['password'])) {
            
                $_SESSION['id'] = $user['id'];
                $_SESSION['user_role'] = $user['role'];
                
                return 202;
            
      
        }
        return null;
    }
    public static function logout(){
        unset($_SESSION['id']);
        unset($_SESSION['user_role']);
        session_destroy();
       
        return true;
    }
    public static function getUserById($pdo,$id)
    {
        try {
            $stmt = $pdo->prepare("SELECT * FROM `user` WHERE `id` = :idd");
            $stmt->execute(['idd' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Couldn't Fetch Users: " . $e->getMessage();
        }
    }


}
?>