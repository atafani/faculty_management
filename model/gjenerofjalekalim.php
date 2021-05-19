<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    $mesazh = "";
    
    if(isset($_POST['gjenero_fjalekalim'])){
        if(isset($_POST['perdorues_id']) && isset($_POST['roli'])) {
            $id_perdorues = (integer)$_POST['perdorues_id'];
            $roli = $_POST['roli'];
            $fjalekalimiRi = gjeneroFjalekalim();
            
            $query_updatepass = "UPDATE perdorues SET fjalekalim = '$fjalekalimiRi' WHERE id_perdorues = '$id_perdorues'";

            if(!mysqli_query($conn, $query_updatepass)){
                $mesazh = "Te dhenat nuk u perditesuan.";
                alert($mesazh);
                die();
            }
            if($roli == "pedagog"){
                header("Location: ../views/admin_views/menaxhopedagoge.php"); 
            } else if($roli == "student"){
                header("Location: ../views/admin_views/shfaqstudente.php"); 
            }
        }
    }
   
    function gjeneroFjalekalim() {
        $karaktere = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = strlen($karaktere);
        $randomStr = '';
        for ($i = 0; $i < 5; $i++) {
            $randomStr .= $karaktere[rand(0, $num - 1)];
        }
        return $randomStr;
    }
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
  
    
?>