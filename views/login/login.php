<?php 
     require("../../model/lidhja.php");
     
     $instanceLidhja = LidhjaDB::getInstance();
     $conn = $instanceLidhja->getLidhje();
    session_start();
   
    if(isset($_SESSION['loguar']) && $_SESSION['loguar']){
        header('location: admin_views/admin_header.php');
    }
    $mesazh = "";

    if(isset($_POST['login'])){
        if(isset($_POST['username']) && isset($_POST['fjalekalim'])){
            $username = $_POST['username'];
            $fjalekalim = $_POST['fjalekalim'];

            $query = "SELECT roli,email_p FROM perdorues WHERE username='$username' AND fjalekalim='$fjalekalim'";

            $rezultati = mysqli_query($conn, $query);

            if(mysqli_num_rows($rezultati) == 1){
                $rr_perdorues = mysqli_fetch_assoc($rezultati);
                $_SESSION['email'] = $rr_perdorues['email_p'];
                $_SESSION['username'] = $username;
                $_SESSION['roli'] = $rr_perdorues['roli'];
                $_SESSION['loguar'] = true;
                
                if(strcmp($rr_perdorues['roli'],"admin")==0){
                    header('Location: ../admin_views/menaxhodepartamente.php');
                }else if(strcmp($_SESSION['roli'],"pedagog") == 0 || strcmp($_SESSION['roli'],"student") == 0){
                    header("Location: ../user_views/orari.php");
                }
               
            }else{
                $mesazh = "Te dhenat e juaja nuk jane te sakta!";
                if(isset($_SESSION['login_count'])){
                    $_SESSION['login_count']++;
                    if($_SESSION['login_count'] == 3){
                        if(session_destroy()) {
                            header("Location: login_error.html");
                        }
                        die();
                    }
                }else{
                    $_SESSION['login_count']=1;
                }
               
            }
        }
    }else{
        $_SESSION['loguar'] = false;
    }
   
    mysqli_close($conn);
?> 

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="cal-icon.ico">
    <title>Login</title>
  
    <style><?php include "login.css"?></style>
    
</head>

<body>
    <div class="container">
        <div class="logo">
            <img src="../images/ftiwhite.png" alt="" class="ftilogo">
        </div>
        
        <div class="login">
            <form action="#" method="post">
                <input type="text" name="username" id="username" placeholder="Username" requires>
                <input type="password" name="fjalekalim" id="fjalekalim" placeholder="Password" required>
                <input type="submit" name="login" value="Log In">
            </form>
            <div class="mesazhi"><?php echo $mesazh?></div>
            <p>Login to view your timetable with the username and password provided by your faculty.</p>
        </div>
    </div>
</body>

</html>