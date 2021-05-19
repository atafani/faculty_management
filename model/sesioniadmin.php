<?php 
 session_start();
 if(!isset($_SESSION['loguar']) || !$_SESSION['loguar']  || strcmp($_SESSION['roli'],"admin") != 0){
         header("Location: ../../model/dil.php");
 }
?>