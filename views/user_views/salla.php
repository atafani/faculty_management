<?php 
    require("user_navbar.php");
    require("../../model/lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    $mesazh = ""; 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Rooms</title>
        <style type="text/css">
            <?php include("../styles/menaxhosalla.css") ?>
        </style>
    </head>
    <body style="margin-top:5em;">
        <div class="nav_salla">
            <button type="button" id="leksion_btn">Lecture Rooms</button>
            <button type="button" id="seminar_btn">Seminar Rooms</button>
            <button type="button" id="lab_btn">Laboratory Rooms</button>
            <button type="button" id="all_btn">All</button>
        </div>
       <div class="sallat">
       <?php
        $query_salle = "SELECT * FROM salle ORDER BY tipologji";

        $rezultati_salle = mysqli_query($conn, $query_salle);

        if(!$rezultati_salle){
            $mesazh = "Nuk u gjenden te dhenat ne baze.";
            die();
        }
        ?>
        
        <?php
            while($rr_salle = mysqli_fetch_assoc( $rezultati_salle)){
                $id_salle = $rr_salle['id_salle'];
                $numer = $rr_salle['numer'];
                $kapacitet = $rr_salle['kapacitet'];
                $tipologji = $rr_salle['tipologji'];
        ?>
        <div class="salla <?php echo $tipologji ?>">
            <p class="numri"><?php echo $numer ?></p>
            <p class="tipologjia"><?php echo $tipologji ." Room" ?></p>
            <p class="kapaciteti"><?php echo "Capacity: " .$kapacitet ?></p>
        </div>
        <?php } ?>

    </div>
    <?php  
        mysqli_close($conn);
    ?>
    <script src="../../controllers/SallaController.js"></script>
    </body>
</html>