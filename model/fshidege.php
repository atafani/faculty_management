<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    $mesazh = "";
    
    if(isset($_POST['fshi_dege'])){
        if(isset($_POST['id_dege'])) {
            $id_dege = (integer)$_POST['id_dege'];

            $query_fshidege = "DELETE FROM dege WHERE id_dege = '$id_dege'";

            if(!mysqli_query($conn, $query_fshidege)){
                $mesazh = "Te dhenat nuk u fshin.";
                die();
            } 
        }
    }
    header("Location: ../views/admin_views/menaxhodepartamente.php");
?>