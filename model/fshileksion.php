<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    $mesazh = "";
    
    if(isset($_POST['fshi_leksion'])){
        if(isset($_POST['id_leksion'])) {
            $id_leksion = (integer)$_POST['id_leksion'];

            $query_fshileksion = "DELETE FROM leksion WHERE id_leksion = '$id_leksion'";

            if(!mysqli_query($conn, $query_fshileksion)){
                $mesazh = "Te dhenat nuk u fshin.";
                die();
            } 
        }
    }
    header("Location: ../views/admin_views/menaxhoorarin.php");
?>