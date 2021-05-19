<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();
    $mesazh = "";
    
    if(isset($_POST['shto_salle'])){
            $numer = (integer)$_POST['numer'];
            $kapacitet = (integer)$_POST['kapacitet'];
            $tipologji = $_POST['tipologji'];


            $query_shtosalle= "INSERT INTO salle(numer, kapacitet, tipologji) VALUES ('$numer', '$kapacitet' , '$tipologji')";

            if(!mysqli_query($conn, $query_shtosalle)){
                $mesazh = "Te dhenat nuk u ruajten.";
                alert($mesazh);
                die();
            }
            
    }
   
    header("Location: ../views/admin_views/menaxhosalla.php");
            
   
        
   
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>