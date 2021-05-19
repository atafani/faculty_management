<?php
    function active($currect_page){
    $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
    $url = end($url_array);  
    if($currect_page == $url){
        echo 'active'; //class name in css 
    } 
    }
require("../../model/sesioniadmin.php");
?> 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
             <?php include("../styles/navbar.css"); ?>
            <?php include("../styles/admin_navbar.css"); ?>
        </style>
        
        <script src="https://kit.fontawesome.com/e51932fb44.js"></script>
        
    </head>
    <body>
        <nav>
            <a href="profiliadmin.php" clasa="profili_icon"><i class="fas fa-user"></i></a>
            <div class="menu_icon" id="menu_icon">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>
            <ul id="navbar" class="navbar">
                <li><a href="menaxhodepartamente.php" class="navlink <?php active('menaxhodepartamente.php');?>">Departamente</a></li>
                <li><a href="menaxhostudente.php"  class="navlink <?php active('menaxhostudente.php');
                active('shfaqstudente.php');?>" >Studente</a></li>
                <li><a href="menaxhopedagoge.php" class="navlink <?php active('menaxhopedagoge.php');?>">Pedagoge</a></li>
                <li><a href="menaxhosalla.php" class="navlink <?php active('menaxhosalla.php');?>">Salla</a></li>
                <li><a href="menaxholende.php" class="navlink <?php active('menaxholende.php');?>">Lende</a></li>
                <li><a href="menaxhoorarin.php" class="navlink <?php active('menaxhoorarin.php');?>">Orari</a></li>
            </ul>
            <a id="logout_btn" class="logout_btn" href="../../model/dil.php"><i class="fas fa-sign-out-alt"></i>Log Out</a>
        </nav>
        <script src="../../controllers/NavbarController.js"></script>
    </body>
</html>