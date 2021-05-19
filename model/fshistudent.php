<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    
    if(isset($_POST['fshi_student'])){
        $id_student = $_POST['id_student'];
        $id_perdorues = $POST['id_perdorues'];


        $query_fshistudent = "DELETE FROM student WHERE id_student = '$id_student'";

        if(!mysqli_query($conn, $query_fshistudent)){
            $mesazh = "Te dhenat e studentit nuk u fshin.";
            alert($mesazh);
            die();
        } 

       
        $query_fshiperdorues = "DELETE FROM perdorues WHERE id_perdorues = '$id_perdorues'";
        if(!mysqli_query($conn, $query_fshiperdorues)){
            $mesazh = "Te dhenat e perdoruesit nuk u fshin.";
            alert($mesazh);
            die();
        }

    }
    header("Location: ../views/admin_views/shfaqstudente.php");
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>
