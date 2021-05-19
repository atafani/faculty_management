<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    
    if(isset($_POST['shto_lende'])){

        if(isset($_FILES['lende_file'])){
            $viti = $_POST['viti'];
            $dege_id = (integer)$_POST['dege_id'];
            $file_tmp = $_FILES['lende_file']['tmp_name'];
        
            $file = fopen($file_tmp, 'r');
            if(!feof($file)){
                fgetcsv($file);
            }
            while(!feof($file)){
                $arr = fgetcsv($file);
                $emer_l = $arr[0];
                ucwords($emer_l);
                $ore_leksion = (integer)$arr[1];
                $ore_seminar = (integer)$arr[2];
                $ore_lab = (integer)$arr[3];

                
                $query_shtolende = "INSERT INTO lende(emer_l,ore_leksion,ore_seminar,ore_lab,viti,dege_id) VALUES ('$emer_l', '$ore_leksion', '$ore_seminar', '$ore_lab', '$viti', '$dege_id')";

                if(!mysqli_query($conn, $query_shtolende)){
                    $mesazh = "Te dhenat nuk u ruajten.";
                    alert($mesazh);
                    die();
                }
              
            }
        }else{
            $mesazh = "File nuk u uplodua";
            alert($mesazh);
            die();
        }
        header("Location: ../views/admin_views/menaxholende.php");
     
    }
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
  
?>