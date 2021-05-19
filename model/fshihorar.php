<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    
    if(isset($_POST['fshih_orar'])){

        $query_fshih = "UPDATE orari SET publikuar = 0";

        if(!mysqli_query($conn, $query_fshih)){
            $mesazh = "Te dhenat nuk u ruajten.";
            alert($mesazh);
            die();
        }
    }
    header("Location: ../views/admin_views/menaxhoorarin.php");
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
  
?>