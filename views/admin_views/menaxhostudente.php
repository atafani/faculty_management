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
        <title>Menaxho Studentet</title>
        <style type="text/css">
            <?php include("../styles/menaxhostudente.css") ?>
        </style>
    </head>
    <body style="margin-top:5em;">

    <div class="container">
    <?php
        $query_dege = "SELECT id_dege,emer_dege,cikel FROM dege ORDER BY cikel ASC";

        $rezultati_dege = mysqli_query($conn, $query_dege);

        if(!$rezultati_dege){
            $mesazh = "Nuk u gjenden te dhenat ne baze.";
            die();
        }

        while($rr_dege = mysqli_fetch_assoc($rezultati_dege)){
            $id_dege = $rr_dege['id_dege'];
            $emer_dege =$rr_dege['emer_dege'] ;
            $cikel = $rr_dege['cikel'];
    ?>
    <div class="dege">
        <p class="emer_dege"><?php echo $cikel ." ne " .$emer_dege?></p>

        <form enctype="multipart/form-data" action="../../model/shtogrup.php" method="post" id="shto_grup_form">
            <input type="hidden" name="dege_id" id="dege_id" value=<?php echo $id_dege ?>>

            <input type="file" name="studente_file" id="studente_file" accept=".csv">

            <label for="viti">Viti:</label>
            <select name="viti" id="viti">
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
            </select>
            <label for="emer_grup">Grupi:</label>
            <select name="emer_grup" id="emer_grup">
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
            <input type="submit" name="shto_grup" id="shto_grup" value="Shto Grup">
        </form>

        <div class="grupet">
            <?php
            $query_grup = "SELECT id_grup, emer_grup, viti FROM grup  WHERE dege_id = '$id_dege' ORDER BY viti ASC,emer_grup ASC";

            $rezultati_grup = mysqli_query($conn, $query_grup);

            if(!$rezultati_grup){
                echo "Nuk u gjenden te dhenat ne baze.";
                die();
            }

            if(mysqli_num_rows($rezultati_grup) >=1){
            ?>
            <table class="grupet">
                <thead>
                    <tr>
                    <th>Grupi</th>
                    <th>Viti</th>
                    <th>Fshi Grup</th>
                    <th>Shfaq Studentet</th>
                    </tr>
                </thead>
            <tbody>
            <?php
                while($rr_gr = mysqli_fetch_assoc($rezultati_grup)){
                    $id_grup = $rr_gr['id_grup'];
                    $emer_grup = $rr_gr['emer_grup'];
                    $viti = $rr_gr['viti'];
                    $emri = $viti ."-" .$emer_grup;
            ?>
            <tr>
            <td><?php echo $emer_grup ?></td>
            <td><?php echo  $viti ?></td>
            <td>
                <form action="../../model/fshigrup.php" method="post">
                    <input type="hidden" name="grup_id" id="grup_id" value=<?php echo $id_grup ?>>
                    <button  type="submit" name="fshi_grup" id="fshi_grup"><i class="fas fa-trash"></i></button>
                </form>
            </td>
            <td>
                <form action="shfaqstudente.php" method="post">
                    <input type="hidden" name="grup_id" id="grup_id" value=<?php echo $id_grup ?>>
                    <input type="hidden" name="emer_dege" id="emer_dege" value=<?php echo "'$emer_dege'" ?>>
                    <input type="hidden" name="emer_grup" id="emer_grup" value=<?php  echo $emri ?>>
                    <button type="submit" name="shfaq_std" id="shfaq_std"><i class="far fa-eye"></i></button>
                </form>
            </td>
            </tr>
            <?php } ?>
            </tbody>
            </table>
            <?php } ?>
        </div>
    </div>
    <?php  
        }
    ?>
    </div>
    <div class="mesazh" style="padding:1em;"><?php echo $mesazh ?></div>
    <?php mysqli_close($conn); ?>
    </body>
</html>