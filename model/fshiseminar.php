<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    $mesazh = "";
    
    if(isset($_POST['fshi_seminar'])){
        if(isset($_POST['id_seminar'])) {
            $id_leksion = (integer)$_POST['id_seminar'];

            $query_fshiseminar = "DELETE FROM seminar WHERE id_seminar = '$id_seminar'";

            if(!mysqli_query($conn, $query_fshiseminar)){
                $mesazh = "Te dhenat nuk u fshin.";
                die();
            } 
        }
    }
    header("Location: ../views/admin_views/menaxhoorarin.php");
?>