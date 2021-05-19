<?php 
    require("user_navbar.php");
    require("../../model/lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();
    require("../../model/OrarData.php");
 
    $mesazh = ""; 
    $email = $_SESSION['email'];

    $query_grup = "SELECT student.grup_id, grup.viti, grup.dege_id, dege.emer_dege FROM grup JOIN student ON grup.id_grup = student.grup_id JOIN dege ON grup.dege_id = dege.id_dege  WHERE student.email_std = '$email'";

    $rezultati_grup = mysqli_query($conn, $query_grup);
    $rr_grup = mysqli_fetch_assoc($rezultati_grup);
    $grup_id = $rr_grup['grup_id'];
    $viti = $rr_grup['viti'];
    $dege_id = $rr_grup['dege_id'];
    $emer_dege =$rr_grup['emer_dege'];

    $query_kontrolloorar = "SELECT publikuar FROM orari";
    $rezultati_kontrolloorar = mysqli_query($conn, $query_kontrolloorar);
    $rr_kontrolloorar = mysqli_fetch_assoc($rezultati_kontrolloorar);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>My Timetable</title>
        <style type="text/css">
            <?php include("../styles/menaxhoorarin.css") ?>
            <?php include("../styles/orariadmin.css") ?>
        </style>
    </head>
    <body style="margin-top: 5em;">
    <?php 
    if($rr_kontrolloorar['publikuar'] == 0){
    ?>
     <div class="papublikuar">
        <img src="../images/notfound.png" alt="">
        <p>Orari nuk eshte publikuar akoma.</p>
    </div>
    <?php
    }else{
    ?>
    
    <div class="orari" style="margin-top: 5em;">
        <table class="orariTable">
        <thead>
        <tr>
            <th class="no-border"></th>
            <th colspan="5"><?php echo $emer_dege ?></th>
            </tr>
            <tr>
                <th class="no-border"></th>
            <?php
            $query_dita = "SELECT * FROM dite";
            $rezultati_dita = mysqli_query($conn, $query_dita);

            if(!$rezultati_dita){
                die();
            }

            while($rr_dita = mysqli_fetch_assoc($rezultati_dita)){
                $id_dita = $rr_dita['id_dite'];
                $emer_dite = $rr_dita['emer_dite'];
            ?>
            <th><?php echo $emer_dite ?></th>
            <?php
            }
            ?>
            </tr>
            
        </thead>

        <tbody>
        <?php  
        for($i=8;$i<20;$i++){
            ?>
            <tr> 
            <td class="no-border"></td>
            <?php
            $query_dita = "SELECT * FROM dite";
            $rezultati_dita = mysqli_query($conn, $query_dita);

            if(!$rezultati_dita){
                die();
            }

            while($rr_dita = mysqli_fetch_assoc($rezultati_dita)){
                $id_dita = $rr_dita['id_dite'];
                $emer_dite = $rr_dita['emer_dite'];
            ?> 
               
                <?php
                    $query_leksion = "SELECT ora_fillimit,ora_mbarimit,lende.emer_l,lende.dege_id,pedagog.emer_pdg,pedagog.mbiemer_pdg,salle.numer FROM leksion JOIN lende ON leksion.lende_id = lende.id_lende JOIN pedagog ON leksion.pedagog_id = pedagog.id_pedagog JOIN salle ON leksion.salle_id = salle.id_salle WHERE lende.viti = '$viti' AND lende.dege_id = '$dege_id' AND leksion.dita = '$id_dita' AND leksion.ora_fillimit <= '$i' AND leksion.ora_mbarimit > '$i'";

                    $query_seminar = "SELECT ora_fillimit,ora_mbarimit,grup_id ,lende.emer_l,pedagog.emer_pdg,pedagog.mbiemer_pdg,salle.numer FROM seminar JOIN lende ON seminar.lende_id = lende.id_lende JOIN pedagog ON seminar.pedagog_id = pedagog.id_pedagog JOIN salle ON seminar.salle_id = salle.id_salle WHERE seminar.grup_id = '$grup_id' AND  lende.viti = '$viti' AND lende.dege_id = '$dege_id' AND seminar.dita = '$id_dita'  AND seminar.ora_fillimit <= '$i' AND seminar.ora_mbarimit > '$i'";

                    $rezultati_leksion = mysqli_query($conn, $query_leksion);

                    $rezultati_seminar = mysqli_query($conn, $query_seminar);

                if(!$rezultati_leksion){
                        die();
                    }
                if(!$rezultati_seminar){
                    
                    die();
                }
                
                if(mysqli_num_rows($rezultati_leksion) == 1){ 
                    $rr_leksion = mysqli_fetch_assoc($rezultati_leksion);
                    $ora_fillimit_leksion = $rr_leksion['ora_fillimit'];
                    $ora_mbarimit_leksion = $rr_leksion['ora_mbarimit'];
                    $emer_lende_leksion = $rr_leksion['emer_l'];
                    $emer_pdg_leksion = $rr_leksion['emer_pdg'];
                    $mbiemer_pdg_leksion = $rr_leksion['mbiemer_pdg'];
                    $nr_salle_leksion = $rr_leksion['numer'];
                    $em_pedagog_leksion = $emer_pdg_leksion[0] ."." .$mbiemer_pdg_leksion;
                    ?>
                    <td class="leksion" >
                    <p><?php echo "(L) " .$emer_lende_leksion ?></p>
                    <p><?php echo $em_pedagog_leksion ?></p>
                    <p><?php echo $nr_salle_leksion ?></p>
                    </td>

                    <?php  
                    }else if(mysqli_num_rows($rezultati_seminar) == 1){
                    $rr_seminar = mysqli_fetch_assoc($rezultati_seminar);
                    $ora_fillimit_seminar = $rr_seminar['ora_fillimit'];
                    $ora_mbarimit_seminar = $rr_seminar['ora_mbarimit'];
                    $grup_id_seminar = $rr_seminar['grup_id'];
                    $emer_lende_seminar = $rr_seminar['emer_l'];
                    $emer_pdg_seminar = $rr_seminar['emer_pdg'];
                    $mbiemer_pdg_seminar = $rr_seminar['mbiemer_pdg'];
                    $nr_salle_seminar = $rr_seminar['numer'];
                    $em_pedagog_seminar = $emer_pdg_seminar[0] ."." .$mbiemer_pdg_seminar;
                    ?>
                        <td class="seminar">
                            <p><?php echo "(S) " .$emer_lende_seminar?></p>
                            <p><?php echo $em_pedagog_seminar ?></p>
                            <p><?php echo $nr_salle_seminar ?></p>
                        </td>
                    <?php 
                    }else {
                        ?>
                    <td></td>
                <?php }
            }?>

            </tr>
            <?php } ?>
            
        </tbody>
    </table>
    </div>
    <script src="../../controllers/UserOrarController.js"></script>
    <?php
    }
        mysqli_close($conn);
    ?>
    </body>
</html>