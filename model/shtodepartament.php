<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    if(isset($_POST['shto_dep'])){
        if(isset($_POST['emer_dep'])) {
            $emer_dep = $_POST['emer_dep'];
            ucwords($emer_dep); //shkronjat e para i kthen ne uppercase

            $query_shtodep = "INSERT INTO departament(emer_dep) VALUES ('$emer_dep')";

            if(!mysqli_query($conn, $query_shtodep)){
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