<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();

    if(isset($_POST['shto_lend'])){
            $dege_id = $_POST['dege_id'];
            $viti = $_POST['viti'];
            $emer_l = $_POST['emer_lende'];
            ucwords($emer_l);
            $ore_leksion = (integer)$_POST['ore_leksion'];
            $ore_seminar = (integer)$_POST['ore_seminar'];
            $ore_lab = (integer)$_POST['ore_lab'];

            
            $query_shtolend = "INSERT INTO lende(emer_l,ore_leksion,ore_seminar,ore_lab,viti,dege_id) VALUES ('$emer_l', '$ore_leksion', '$ore_seminar', '$ore_lab', '$viti', '$dege_id')";

            if(!mysqli_query($conn, $query_shtolend)){
                $mesazh = "Te dhenat nuk u ruajten.";
                alert($mesazh);
                die();
            }
            
    }
    
    header("Location: ../views/admin_views/menaxholende.php");
            
  
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
  
?>