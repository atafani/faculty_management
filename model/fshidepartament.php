<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();
    $mesazh = "";
    
    if(isset($_POST['fshi_dep'])){
        if(isset($_POST['id_dep'])) {
            $id_dep = (integer)$_POST['id_dep'];

            $query_fshidep = "DELETE FROM departament WHERE id_dep = '$id_dep'";

            if(!mysqli_query($conn, $query_fshidep)){
                $mesazh = "Te dhenat nuk u fshin.";
                die();
            } 
        }
    }
    header("Location: ../views/admin_views/menaxhodepartamente.php");
?>