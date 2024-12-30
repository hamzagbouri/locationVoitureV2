<?php 
require_once('../classes/User.php');


        $res = User::logout();
        if($res)
        {
            header("Location: ../../public/index.php");
        }
 