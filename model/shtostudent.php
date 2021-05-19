<?php 
    require("lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    if(isset($_POST['shto_std'])){
        if(isset($_POST['emer_std']) && isset($_POST['mbiemer_std'])) {
            $grup_id = $_POST['grup_id'];
            $emer_std = $_POST['emer_std'];
            $mbiemer_std = $_POST['mbiemer_std'];
            $roli = "student";
            $email_std = $_POST['email_std'];
            ucwords($emer_std);
            ucwords($mbiemer_std); //shkronjat e para i kthen ne uppercase

            $query_kontrollo = "SELECT * FROM student WHERE email_std = '$email_std'";

            if(mysqli_num_rows(mysqli_query($conn, $query_kontrollo)) > 0 ) {
                $mesazh = "Perdoruesi '$emer_std' '$mbiemer_std' ekziston!";
                alert($mesazh);
                die();
            }

            $username = $emer_std ."." .$mbiemer_std;
            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM perdorues WHERE username = '$username'"))>0){
                $username = $emer_std ."_" .$mbiemer_std;
            }
            $fjalekalim = gjeneroFjalekalim();

            $query_shtostd = "INSERT INTO student(emer_std,mbiemer_std, email_std, grup_id) VALUES ('$emer_std', '$mbiemer_std', '$email_std', '$grup_id')";

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
    header("Location: ../views/admin_views/shfaqstudente.php");
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