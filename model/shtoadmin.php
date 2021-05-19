<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    if(isset($_POST['shto_adm'])){
        $emer_adm = $_POST['emer_adm'];
        $mbiemer_adm = $_POST['mbiemer_adm'];
        $email_adm = $_POST['email_adm'];
        
        $query_kontrollo = "SELECT * FROM admin WHERE email_adm = '$email_adm'";

        if(mysqli_num_rows(mysqli_query($conn, $query_kontrollo)) > 0 ) {
            $mesazh = "Admini '$emer_adm' '$mbiemer_adm' ekziston!";
            alert($mesazh);
            die();
        }


        $query_shtoadm = "INSERT INTO admin(emer_adm, mbiemer_adm, email_adm) VALUES('$emer_adm', '$mbiemer_adm', '$email_adm')";

        if(!mysqli_query($conn, $query_shtoadm)){
            $mesazh = "Te dhenat e adminit nuk u ruajten.";
            alert($mesazh);
            die();
        } 

        $username = $emer_adm ."." .$mbiemer_adm;
        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM perdorues WHERE username = '$username'"))>0){
            $username = $emer_adm ."_" .$mbiemer_adm;
        }
        $fjalekalim = gjeneroFjalekalim();
        $roli = "admin";

        $query_shtoperdorues = "INSERT INTO perdorues(username, fjalekalim, roli, email_p) VALUES('$username', '$fjalekalim', '$roli', '$email_adm')";

        if(!mysqli_query($conn, $query_shtoperdorues)){
            $mesazh = "Te dhenat e perdoruesit nuk u ruajten";
            alert($mesazh);
            die();
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