<?php 
    require("admin_navbar.php");
    require("../../model/lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

 
    $mesazh = ""; 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Menaxho Salla</title>
        <style type="text/css">
            <?php include("../styles/menaxhosalla.css") ?>
        </style>
    </head>
    <body style="margin-top:5em;">
        <div class="nav_salla">
            <button type="button" id="leksion_btn">Salla Leksioni</button>
            <button type="button" id="seminar_btn">Salla Seminari</button>
            <button type="button" id="lab_btn">Salla Laboratori</button>
            <button type="button" id="all_btn">Te gjitha</button>
        </div>
       <form enctype="multipart/form-data"  action="../../model/shtosalla.php" method="post" id="shto_salla_form">
            <input type="file" name="salla_file" id="salla_file" accept=".csv" required >
            <input type="submit" name="shto_salla" id="shto_salla" value="Shto Salla">
       </form>
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
            <p class="numri"><?php echo  "No. " .$numer ?></p>
            <p class="tipologjia"><?php echo $tipologji ." Room" ?></p>
            <p class="kapaciteti"><?php echo "Capacity: " .$kapacitet ?></p>
            <form action="../../model/fshisalle.php" method="post">
                <input type="hidden" name="id_salle" id="id_salle" value=<?php echo $id_salle ?>>
                <button type="submit" name="fshi_salle" id="fshi_salle" ><i class="fas fa-trash"></i></button>
            </form>
        </div>
        <?php } ?>
        

    </div>
    <form action="../../model/shtosalle.php" method="post" id="shto_salle_form">
        <input type="text" name="numer" id="numer" placeholder="Numri:" required>
        <select name="tipologji" id="tipologji">
                <option value="lecture">Leksion</option>
                <option value="seminar">Seminar</option>
                <option value="laboratory">Laborator</option>
        </select>
        <input type="text" name="kapacitet" id="kapacitet" placeholder="Kapaciteti:" required>
        <input type="submit" name="shto_salle" id="shto_salle" value="Shto Salle">
        </form> 
    <?php  
        mysqli_close($conn);
    ?>
    <script src="../../controllers/SallaController.js"></script>
    </body>
</html>