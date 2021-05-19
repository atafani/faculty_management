<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    
    
    if(isset($_POST['fshi_pedagog'])){
        $id_pedagog = $_POST['id_pedagog'];
        $id_perdorues = $POST['id_perdorues'];

        $query_fshipedagog = "DELETE FROM pedagog WHERE id_pedagog = '$id_pedagog'";

        if(!mysqli_query($conn, $query_fshipedagog)){
            $mesazh = "Te dhenat e pedagogut nuk u fshin.";
            alert($mesazh);
            die();
        } 

        $query_fshiperdorues = "DELETE FROM perdorues WHERE email_p = '$email_adm'";
        if(!mysqli_query($conn, $query_fshiperdorues)){
            $mesazh = "Te dhenat e perdoruesit nuk u fshin.";
            alert($mesazh);
            die();
        }

    }
    header("Location: ../views/admin_views/menaxhopedagoge.php");
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>
