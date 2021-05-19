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
        <title>Menaxho Departamentet</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            <?php include("../styles/menaxhodepartamente.css") ?>
        </style>
    </head>
    <body>
    <div class="menaxho_departamentet">
        <div class="shto_departament">
            <form action="../../model/shtodepartament.php" method="post" class="shtodep_form">
                <input type="text" name="emer_dep" id="emer_dep" placeholder="Emri i departamentit" required>
                <input type="submit" name="shto_dep" id="shto_dep" value="Shto Departament">
            </form>
        </div>
        <div class="departamentet_container">
            <h1 class="title">Departamentet</h1>
        <div class="departamentet">
            <?php
                $query_dep = "SELECT * FROM departament";

                $rezultati_dep = $conn->query($query_dep);
                if(!$rezultati_dep){
                    $mesazh = "Nuk u gjenden te dhenat ne baze.";
                    die();
                }
                while($rr_d = $rezultati_dep->fetch_assoc()){
                    $emer_dep = $rr_d['emer_dep'];
                    $dep_id = $rr_d['id_dep'];
            ?>
                <div class="departamenti">
                    <div  class="emer_dep">
                        <p><?php echo $emer_dep?></p>
                        <form action="../../model/fshidepartament.php" method="post">
                            <input type="hidden" name="id_dep" id="id_dep" value=<?php echo  $dep_id ?>>
                            <button type="submit" name="fshi_dep" id="fshi_dep" ><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    
                    <form action="../../model/shtodege.php" method="post" class="shtodege_form">
                        <input type="text" name="emer_dege" id="emer_dege" required  placeholder="Emri i Deges">
                        <input type="hidden" name="dep_id" id="dep_id" value=<?php echo $dep_id?>>
                        <select name="cikel" id="cikel">
                            <option value="Bachelor">Bachelor</option>
                            <option value="Bachelor">Master</option>
                        </select>
                        <input type="submit" name="shto_dege" id="shto_dege"  value="Shto Dege">
                    </form>
                    
                    <div class="deget_studimit">
                            <?php
                            $query_dege = "SELECT * FROM dege WHERE dep_id = '$dep_id'  ORDER BY cikel ASC";

                            $rezultati_dege = mysqli_query($conn, $query_dege);

                            if(!$rezultati_dege){
                                $mesazh = "Nuk u gjenden te dhenat ne baze.";
                                die();
                            }
                            if(mysqli_num_rows($rezultati_dege)){
                                ?>
                                <h2>Deget e Studimit</h2>
                           <?php
                            while($rr_dege = mysqli_fetch_assoc($rezultati_dege)){
                                $id_dege = $rr_dege['id_dege'];
                                $emer_dege =$rr_dege['emer_dege'] ;
                                $cikel = $rr_dege['cikel'];
                        ?>
                        <div class="dege">
                            <a class="emer_dege" href="#"><?php echo $cikel ." ne " .$emer_dege?></a>
                            <form action="../../model/fshidege.php" method="post">
                                <input type="hidden" name="id_dege" id="id_dege" value=<?php echo $id_dege ?>>
                                <button type="submit" name="fshi_dege" id="fshi_dege" ><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                        <?php  
                            }
                        }
                        ?>
                    </div>
                </div>
                <?php  
                    }
                ?>
        </div>
        </div>           
    </div>
    <div class="mesazh"><?php echo $mesazh ?></div>
    <?php 
        mysqli_close($conn);
    ?>
    </body>
</html>