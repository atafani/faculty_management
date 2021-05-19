<?php 
     require("lidhja.php");

     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    
    if(isset($_POST['shto_grup'])){
        $emer_grup = $_POST['emer_grup'];
        $dege_id = $_POST['dege_id'];
        $viti = $_POST['viti'];
        
        $query_kontrollo = "SELECT * FROM grup WHERE emer_grup = '$emer_grup' AND dege_id = '$dege_id' AND viti = '$viti'";
        if(mysqli_num_rows(mysqli_query($conn, $query_kontrollo))>0){
           $mesazh = "Ekziston nje grup me keto te dhena";
           alert($mesazh);
           die();
        }
        
        $query_shtogr = "INSERT INTO grup(emer_grup, viti, dege_id) VALUES ('$emer_grup', '$viti', '$dege_id')";

        if(!mysqli_query($conn, $query_shtogr)){
            die();
        }
        $last_idgr = mysqli_insert_id($conn);

        if(isset($_FILES['studente_file']) && $_FILES['studente_file']['size'] > 0){
            $file_tmp = $_FILES['studente_file']['tmp_name'];
            $file = fopen($file_tmp, 'r');

            if(!feof($file)){
              fgetcsv($file);
            }
            while(!feof($file)){
                $arr = fgetcsv($file);
                $emer_std = $arr[0];
                $mbiemer_std = $arr[1];
                $roli = "student";
                $email_std = $arr[2];

                $query_kontrollo = "SELECT * FROM student WHERE email_std = '$email_std'";

                if(mysqli_num_rows(mysqli_query($conn, $query_kontrollo)) > 0 ) {
                    $mesazh = "Perdoruesi '$emer_std' '$mbiemer_std' ekziston!";
                    alert($mesazh);
                    die();
                }

                $username = $emer_std ."." .$mbiemer_std;
                 
                $fjalekalim = gjeneroFjalekalim();

                $query_shtostd = "INSERT INTO student(emer_std,mbiemer_std, email_std, grup_id) VALUES ('$emer_std', '$mbiemer_std', '$email_std', '$last_idgr')";

                if(!mysqli_query($conn, $query_shtostd)){
                    $mesazh = "Te dhenat nuk u ruajten.";
                    alert($mesazh);
                    die();
                }
                

                $query_shtoperdorues = "INSERT INTO perdorues(username, fjalekalim, roli,email_p) VALUES ('$username', '$fjalekalim', '$roli' ,'$email_std' )";

                if(!mysqli_query($conn, $query_shtoperdorues)){
                    $mesazh = "Te dhenat nuk u ruajten.";
                    alert($mesazh);
                    die();
                }
            }
        }    
        header("Location: ../views/admin_views/menaxhostudente.php");
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
        function alert($msg){
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
  
?>