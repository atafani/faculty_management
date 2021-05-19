<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    $mesazh = "";
    
    if(isset($_POST['fshi_lende'])){
        $id_lende = $_POST['id_lende'];

        $query_fshilende = "DELETE FROM lende WHERE id_lende = '$id_lende'";

        if(!mysqli_query($conn, $query_fshilende)){
            $mesazh = "Te dhenat nuk u fshin.";
            alert($mesazh);
            die();
        } 
    }
    header("Location: ../views/admin_views/menaxholende.php");
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>