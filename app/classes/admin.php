<?php
require 'database.php';
require 'user.php';


class Admin extends User {
    

    public function __construct($id = null, $email, $fullName, $password, $role = 'admin') {
        parent::__construct($id,$email,$fullName,$password,$role);
    }


}
?>