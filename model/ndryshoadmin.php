<?php 
    require("lidhja.php");
    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    if(isset($_POST['ndrysho_adm'])){
        if(isset($_POST['emer']) && isset($_POST['mbiemer']) && isset($_POST['email']) ){
        $id_admin = $_POST['id_admin'];
        $emer_adm = $_POST['emer'];
        $mbiemer_adm = $_POST['mbiemer'];
        $email_adm = $_POST['email'];
        
        $query_ndryshoadmin = "UPDATE admin SET emer_adm ='$emer_adm', mbiemer_adm = '$mbiemer_adm', email_adm = '$email_adm' WHERE id_admin = '$id_admin'";

        if(mysqli_query($conn, $query_ndryshoadmin)) {
            $mesazh = "Te dhenat nuk u ndryshuan.";
            alert($mesazh);
            die();
        }


        $username = $emer_adm ."." .$mbiemer_adm;
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM perdorues WHERE username = '$username'"))>0){
            $username = $emer_adm ."_" .$mbiemer_adm;
        }
        $fjalekalim = gjeneroFjalekalim();

        $query_ndryshoperdorues = "UPDATE perdorues SET username = '$username', fjalekalimi = '$fjalekalim'";

        if(!mysqli_query($conn, $query_ndryshoperdorues)){
            $mesazh = "Te dhenat e perdoruesit nuk u ruajten";
            alert($mesazh);
            die();
        }
            
    }
        
    }

    header("Location: ../views/admin_views/profiliadmin.php");
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }
     //gjenero password
     function gjeneroFjalekalim() {
        $karaktere = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = strlen($karaktere);
        $randomStr = '';
        for ($i = 0; $i < 5; $i++) {
            $randomStr .= $karaktere[rand(0, $num - 1)];
        }
        return $randomStr;
    }
?>