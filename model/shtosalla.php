<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    $mesazh = "";
    
    if(isset($_POST['shto_salla'])){
        if(isset($_FILES['salla_file'])){
            $file_tmp = $_FILES['salla_file']['tmp_name'];
        
            $file = fopen($file_tmp, 'r');
            if(!feof($file)){
                fgetcsv($file);
            }
            while(!feof($file)){
                $arr = fgetcsv($file);
                $numer = (integer)$arr[0];
                $kapacitet = (integer)$arr[1];
                $tipologji = $arr[2];


                $query_shtosalle= "INSERT INTO salle(numer, kapacitet, tipologji) VALUES ('$numer', '$kapacitet' , '$tipologji')";

                if(!mysqli_query($conn, $query_shtosalle)){
                    $mesazh = "Te dhenat nuk u ruajten.";
                    alert($mesazh);
                    die();
                }
               
            }
        } 
        header("Location: ../views/admin_views/menaxhosalla.php");
            
   
        
    }
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
?>