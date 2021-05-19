<?php
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'active'; //class name in css 
  } 
}
require("../../model/sesioniuser.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://kit.fontawesome.com/e51932fb44.js"></script>
        
        <style>
            <?php   include("../styles/navbar.css") ?>
        </style>
    </head>
    <body>
        <header>
            <nav>
            <a href="profiliuser.php" class="profili_icon"><i class="fas fa-user"></i></a>
            <div class="menu_icon" id="menu_icon">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
                <ul id="navbar" class="navbar">
                    <li><a class="navlink <?php active('orari.php');?>" href="orari.php">Timetable</a></li>
                    <li><a class="navlink <?php 
                    
                    if(strcmp($_SESSION['roli'],"student") == 0){
                        active('oraristudent.php');
                    }else{
                        active('oraripedagog.php');
                    }
                    ?>
                    " href=<?php 
                    if(strcmp($_SESSION['roli'],"student") == 0){
                        echo "oraristudent.php";
                    }else{
                        echo "oraripedagog.php";
                    }
                    ?> >My Timetable</a></li>
                    <li><a class="navlink <?php active('salla.php');?>" href="salla.php" >Rooms</a></li>
                </ul>
                <a id="logout_btn" class="logout_btn" href="../../model/dil.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
            </nav>
        </header>
        <script src="../../controllers/NavbarController.js"></script>
    </body>
</html>