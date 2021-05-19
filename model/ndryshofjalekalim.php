<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    $mesazh = "";
    
    if(isset($_POST['ndrysho_fjalekalim'])){
        if(isset($_POST['email_p']) && isset($_POST['roli']) && isset($_POST['fjalekalimi_ri'])) {
            $email_p = $_POST['email_p'];
            $roli = $_POST['roli']; 
            $fjalekalimiRi = $_POST['fjalekalimi_ri'];
            
            $query_updatepass = "UPDATE perdorues SET fjalekalim = '$fjalekalimiRi' WHERE email_p = '$email_p'";

            if(!mysqli_query($conn, $query_updatepass)){
                $mesazh = "Te dhenat nuk u perditesuan.";
                alert($mesazh);
                die();
            }
            if($roli == "admin"){
                header("Location: ../views/admin_views/profiliadmin.php"); 
            } else{
                header("Location: ../views/admin_views/profiliuser.php"); 
            }
        }
    }
   
   
    
?>