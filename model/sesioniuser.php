<?php 
 session_start();
 if(!isset($_SESSION['loguar']) || !$_SESSION['loguar']  || (strcmp($_SESSION['roli'],"pedagog") != 0 &&  strcmp($_SESSION['roli'],"student") != 0)){
         header("Location: ../../model/dil.php");
 }
?>