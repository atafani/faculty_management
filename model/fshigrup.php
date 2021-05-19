<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    $mesazh = "";
    
    if(isset($_POST['fshi_grup'])){
        $id_grup = $_POST['grup_id'];

        $query_fshigrup = "DELETE FROM grup WHERE id_grup = '$id_grup'";
        $query_fshistudente = "DELETE FROM student WHERE grup_id = '$id_grup";

        if(!mysqli_query($conn, $query_fshigrup)){
            $mesazh = "Te dhenat e grupit nuk u fshin.";
            alert($mesazh);
            die();
        }
        if(!mysqli_query($conn, $query_fshistudente)){
            $mesazh = "Te dhenat e studenteve nuk u fshin.";
            alert($mesazh);
            die();
        }
    
    }
    header("Location: ../views/admin_views/menaxhostudente.php");
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>