<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    $mesazh = "";
    
    if(isset($_POST['shto_dege'])){
        if(isset($_POST['emer_dege'])) {
            $emer_dege = $_POST['emer_dege'];
            $cikel = $_POST['cikel'];
            $dep_id = (integer) $_POST['dep_id'];

            ucwords($emer_dege); //shkronjat e para i kthen ne uppercase

            $query_shtodege = "INSERT INTO dege(emer_dege,cikel,dep_id) VALUES ('$emer_dege','$cikel','$dep_id')";

            if(!mysqli_query($conn, $query_shtodege)){
                $mesazh = "Te dhenat nuk u ruajten.";
                alert($mesazh);
                die();
            }
            
        }
    }
    header("Location: ../views/admin_views/menaxhodepartamente.php");
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>