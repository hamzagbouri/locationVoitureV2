<?php 

require_once('../classes/avis.php');
require_once('../classes/database.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $idAvis = $_POST['avisId'];

    $dbInstance = Database::getInstance();
    $pdo = $dbInstance->getConnection();
    if(isset($_POST['archive']))
{
     
        $result = Avis::archiveAvis($pdo,$idAvis,true);
        if($result){
            echo $result;
            header("Location: ../../public/admin/avis.php");
        }
    } else if (isset($_POST['unarchive']))
    {
        $result = Avis::archiveAvis($pdo,$idAvis,false);
        if($result){
            echo $result;
            header("Location: ../../public/admin/avis.php");
        }
    }
}


        

   