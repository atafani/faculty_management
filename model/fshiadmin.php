<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

   
    if(isset($_POST['fshi_admin'])){
        $id_admin = $_POST['id_admin'];
        $email_adm = $_POST['email_adm'];

        $query_fshipedagog = "DELETE FROM admin WHERE id_admin = '$id_admin'";

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
    header("Location: ../views/admin_views/profiliadmin.php");
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>