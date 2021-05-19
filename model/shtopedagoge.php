<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();
    
    if(isset($_POST['shto_pedagoge'])){
        $dep_id = $_POST['dep_id'];
        if(isset($_FILES['pedagoge_file'])){
            $file_tmp = $_FILES['pedagoge_file']['tmp_name'];
        
            $file = fopen($file_tmp, 'r');
            if(!feof($file)){
                fgetcsv($file);
            }
            while(!feof($file)){
                $arr = fgetcsv($file);
                $emer_pdg = $arr[0];
                $mbiemer_pdg = $arr[1];
                $email_pdg = $arr[2];
                $roli = "pedagog";

                $query_kontrollo = "SELECT * FROM pedagog WHERE email_pdg = '$email_pdg'";

                if(mysqli_num_rows(mysqli_query($conn, $query_kontrollo)) > 0 ) {
                    $mesazh = "Pedagogu '$emer_pdg' '$mbiemer_pdg' ekziston!";
                    alert($mesazh);
                    die();
                }

                $username = $emer_pdg ."." .$mbiemer_pdg;
              
                $fjalekalim = gjeneroFjalekalim();

                $query_shtopdg = "INSERT INTO pedagog(emer_pdg,mbiemer_pdg, email_pdg, dep_id) VALUES ('$emer_pdg', '$mbiemer_pdg', '$email_pdg', '$dep_id')";

                if(!mysqli_query($conn, $query_shtopdg)){
                    $mesazh = "Te dhenat e pedagogeve nuk u ruajten.";
                    alert($mesazh);
                    die();
                }
            

                $query_shtoperdorues = "INSERT INTO perdorues(username, fjalekalim,roli, email_p) VALUES ('$username', '$fjalekalim' ,'$roli' ,'$email_pdg' )";

                if(!mysqli_query($conn, $query_shtoperdorues)){
                    $mesazh = "Te dhenat e perdoruesit nuk u ruajten";
                    alert($mesazh);
                    die();
                }
                
            }
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