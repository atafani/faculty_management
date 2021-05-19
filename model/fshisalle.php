<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    $mesazh = "";
    
    if(isset($_POST['fshi_salle'])){
        if(isset($_POST['id_salle'])) {
            $id_salle = (integer)$_POST['id_salle'];

            $query_fshisalle = "DELETE FROM salle WHERE id_salle = '$id_salle'";

            if(!mysqli_query($conn, $query_fshisalle)){
                $mesazh = "Te dhenat nuk u fshin.";
                alert($mesazh);
                die();
            } 
        }
    }
    header("Location: ../views/admin_views/menaxhosalla.php");
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>