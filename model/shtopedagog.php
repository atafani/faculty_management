<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    if(isset($_POST['shto_pedagog'])){
        $dep_id = $_POST['dep_id'];
        $emer_pdg = $_POST['emer_pdg'];
        $mbiemer_pdg = $_POST['mbiemer_pdg'];
        $email_pdg = $_POST['email_pdg'];
        $roli = "pedagog";
        
        ucwords($emer_pdg);
        ucwords($mbiemri_pdg);

        $query_kontrollo = "SELECT * FROM pedagog WHERE email_pdg = '$email_pdg'";

        if(mysqli_num_rows(mysqli_query($conn, $query_kontrollo)) > 0 ) {
            $mesazh = "Perdoruesi '$emri_pdg' '$mbiemri_pdg' ekziston!";
            alert($mesazh);
            die();
        }

        $username = $emer_pdg ."." .$mbiemer_pdg;
      

        $fjalekalim = gjeneroFjalekalim();

        $query_shtopdg = "INSERT INTO pedagog(emer_pdg,mbiemer_pdg, email_pdg, dep_id) VALUES ('$emer_pdg', '$mbiemer_pdg', '$email_pdg', '$dep_id')";

        if(!mysqli_query($conn, $query_shtopdg)){
            $mesazh = "Te dhenat e pedagogut nuk u ruajten.";
            alert($mesazh);
            die();
        }
        $last_idpdg = mysqli_insert_id($conn);

        $query_shtoperdorues = "INSERT INTO perdorues(username, fjalekalim,roli, email_p) VALUES ('$username', '$fjalekalim' ,'$roli' ,'$email_pdg' )";

        if(!mysqli_query($conn, $query_shtoperdorues)){
            $mesazh = "Te dhenat e perdoruesit nuk u ruajten.";
            alert($mesazh);
            die();
        }
       
    }
    header("Location: ../views/admin_views/menaxhopedagoge.php");
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
        function alert($msg){
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
  
?>