<?php 
    require("admin_navbar.php");
    require("../../model/lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    require("../../model/OrarData.php");

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Menaxho Orar</title>
        <style type="text/css">
            <?php include("../styles/menaxhoorarin.css") ?>
            <?php include("../styles/orariadmin.css") ?>
        </style>
    </head>
    <body style="margin-top:5em;">
    
        <div class="container">
            <h2>Shto Leksione, Seminare dhe Laboratore</h2>
            <div class="forms">
            <form id="orar_form" action="../../model/shtoorar.php" method="post"> 
            <div>
                <label for="id_dege">Dega:</label>
                <select name="id_dege" id="id_dege">
                    <?php
                    foreach($degeIdName as $id_dege => $emer_dege){
                    ?>
                    <option value=<?php echo $id_dege ?>><?php echo $emer_dege ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="viti">Viti:</label>
                <select name="viti" id="viti">
                    <?php
                    for(reset($degeIdName);$id_dege=key($degeIdName);next($degeIdName)){
                        for(reset($nrGrupe[$id_dege]);$viti=key($nrGrupe[$id_dege]);next($nrGrupe[$id_dege])){
                    ?>
                    <option class=<?php echo $id_dege ?> value=<?php echo $viti ?>><?php echo $viti ?></option>
                    <?php
                        } 
                    }
                    ?>
                </select>
            </div>
            <div>
            <label for="lende_id">Lenda:</label>
            <select name="lende_id" id="lende_id">
                <?php
                for(reset($degeIdName);$id_dege=key($degeIdName);next($degeIdName)){
                    for(reset($nrGrupe[$id_dege]);$viti=key($nrGrupe[$id_dege]);next($nrGrupe[$id_dege])){

                    $query_lende = "SELECT id_lende, emer_l FROM lende WHERE viti = '$viti' AND dege_id = '$id_dege'";

                    $rezultati_lende = mysqli_query($conn, $query_lende);
                    if(!$rezultati_lende){
                        $mesazh = "Te dhenat nuk u gjenden.";
                        die();
                    }
                    
                    while($rr_lende = mysqli_fetch_assoc($rezultati_lende)){
                        $id_lende = $rr_lende['id_lende'];
                        $emer_lende = $rr_lende['emer_l'];
                        
                ?>
                <option class=<?php echo "lende" .$id_dege .$viti?> value=<?php echo $id_lende ?>><?php echo $emer_lende ?></option>
                <?php
                    }}}
                ?>
            </select>
            </div>
            <div>
                <label for="tipi">Cfare do shtoni?</label>
            <select name="tipi" id="tipi">
                <option value="leksion">Leksion</option>
                <option value="seminar">Seminar</option>
                <option value="lab">Laborator</option>
            </select>
            </div>
            <div>
                <label for="id_grup">Grupi:</label>
                <select name="id_grup" id="id_grup">
                    <?php
                    for(reset($degeIdName);$id_dege=key($degeIdName);next($degeIdName)) {
                        for(reset($nrGrupe[$id_dege]);$viti=key($nrGrupe[$id_dege]);next($nrGrupe[$id_dege])) {
                            for(reset($grupeIdName[$id_dege][$viti]);$id_grup = key($grupeIdName[$id_dege][$viti]);next($grupeIdName[$id_dege][$viti])){ 

                            $emer_grup = $grupeIdName[$id_dege][$viti][$id_grup];
                    ?>
                    <option class=<?php echo "grup" .$id_dege .$viti ?> value=<?php echo $id_grup ?>><?php echo $emer_grup ?></option>
                    <?php
                        }}}
                    ?>
                </select>
            </div>
            <div>
                <label for="pedagog_id">Pedagogu:</label>
                <select name="pedagog_id" id="pedagog_id">
                    <?php
                        $query_pedagog = "SELECT id_pedagog,emer_pdg,mbiemer_pdg FROM pedagog";

                        $rezultati_pdg = mysqli_query($conn, $query_pedagog);

                        if(!$rezultati_pdg){
                            $mesazh = "Te dhenat nuk u gjenden.";
                            die();
                        }
                        
                        while($rr_pdg = mysqli_fetch_assoc($rezultati_pdg)){
                            $id_pedagog = $rr_pdg['id_pedagog'];
                            $emer_pdg = $rr_pdg['emer_pdg'];
                            $mbiemer_pdg = $rr_pdg['mbiemer_pdg'];
                    ?>
                    <option value=<?php echo $id_pedagog ?>><?php echo $emer_pdg ." " .$mbiemer_pdg  ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                <label for="dita">Dita:</label>
                <select name="dita" id="dita" >
                    <?php
                        $query_dite = "SELECT * FROM dite";

                        $rezultati_dite = mysqli_query($conn, $query_dite);
                        if(!$rezultati_dite){
                            $mesazh = "Te dhenat nuk u gjenden";
                            die();
                        }
                        while($rr_dite = mysqli_fetch_assoc($rezultati_dite)){
                            $id_dite = $rr_dite['id_dite'];
                            $emer_dite = $rr_dite['emer_dite'];
                    ?>
                    <option value=<?php echo $id_dite ?>><?php echo $emer_dite ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                 <label for="ora_fillimit">Ora Fillimit:</label>
                <select name="ora_fillimit" id="ora_fillimit">
                    <?php
                        for($i=8;$i<=19;$i++){
                    ?>
                    <option value=<?php echo $i ?>><?php echo $i .":00" ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div>
                 <label for="ora_mbarimit">Ora Mbarimit:</label>
                <select name="ora_mbarimit" id="ora_mbarimit">
                    <?php
                        for($i=8;$i<=19;$i++){
                    ?>
                    <option value=<?php echo $i ?>><?php echo $i .":00" ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>            
            <div>
                <label for="salle_id">Salla: </label>
                <select name="salle_id" id="salle_id">
                <?php
                        $query_salle= "SELECT * FROM salle";

                        $rezultati_salle = mysqli_query($conn, $query_salle);

                        if(!$rezultati_salle){
                            $mesazh = "Te dhenat nuk u gjenden.";
                            die();
                        }

                        while($rr_salle = mysqli_fetch_assoc($rezultati_salle)){
                            $id_salle = $rr_salle['id_salle'];
                            $numer = $rr_salle['numer'];
                            $kapacitet = $rr_salle['kapacitet'];

                    ?>
                    <option value=<?php echo $id_salle ?>><?php echo $numer ." Kapaciteti:" .$kapacitet  ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
        
       
       
        
        <input type="submit" name="shto_orar" id="shto_orar" value="Shto">
        </form>

        <div class="veprime_orar">
            <?php 
                $query_kontrolloorar = "SELECT publikuar FROM orari";
                $rr_kontrolloorar = mysqli_fetch_assoc(mysqli_query($conn, $query_kontrolloorar));
                $statusi = $rr_kontrolloorar['publikuar'];
                if($statusi == 0){
                    ?>
                    <p class="statusi"><span>Publikuar:</span>Jo</p>
                    <?php
                }else{
                    ?>
                     <p class="statusi"><span>Publikuar:</span>Po</p>
                    <?php
                }
            ?>
            
            <form action="../../model/publikoorar.php" id="publiko_orar_form" method="post">
                <input type="submit" name="publiko_orar" id="publiko_orar" value="Publiko Orar">
            </form>
            <form action="../../model/fshihorar.php" id="fshih_orar_form" method="post">
                <input type="submit" name="fshih_orar" id="fshih_orar" value="Fshih Orar">
            </form>
        </div>
            
        </div>
        </div>
        <?php  
        require("orariadmin.php");
    ?>
    
    <?php  
        mysqli_close($conn);
    ?>
    <script type="text/javascript" src="../../controllers/OrarController.js"></script>
    </body>
</html>