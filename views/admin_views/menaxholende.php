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
        <title>Menaxho Lende</title>
        <style type="text/css">
            <?php include("../styles/menaxholende.css") ?>
        </style>
    </head>
    <body style="margin-top:5em;">
    
    <div class="deget">
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
       <form  enctype="multipart/form-data"  action="../../model/shtolende.php" method="post">
        <input type="hidden" name="dege_id" id="dege_id" value=<?php echo $id_dege ?>>
        <label for="viti">Viti:</label>
            <select name="viti" id="viti">
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
            </select>
            <input type="file" name ="lende_file" id="lende_file" accept=".csv" >
            <input type="submit"  name="shto_lende" id="shto_lende" value="Shto Lende">
       </form>
       <?php
            $query_vit = "SELECT DISTINCT viti FROM lende ORDER BY viti";
            $rezultati_vit = mysqli_query($conn, $query_vit);
            if(!$rezultati_vit){
                $mesazh = "Te dhenat nuk u gjenden.";
                die();
            }
            while($rr_vit = mysqli_fetch_assoc($rezultati_vit)){
                $viti = $rr_vit['viti'];
           ?>
           <table class="lende_tbl">
            <caption><?php echo "Viti " .$viti ?></caption>
                <thead>
                    <tr>
                        <th>Emri</th>
                        <th>Ore Leksione</th>
                        <th>Ore Seminare</th>
                        <th>Ore Laboratore</th>
                        <th>Fshi</th>
                    </tr>
                </thead>
                <tbody>
           <?php
           
            $query_lende = "SELECT * FROM lende WHERE dege_id = '$id_dege' AND viti = '$viti'";

            $rezultati_lende = mysqli_query($conn, $query_lende);
            if(!$rezultati_lende){
                $mesazh = "Te dhenat nuk u gjenden.";
                die();
            }

            while($rr_lende = mysqli_fetch_assoc($rezultati_lende)){
                $id_lende = $rr_lende['id_lende'];
                $emer_l = $rr_lende['emer_l'];
                $ore_leksion =$rr_lende['ore_leksion'];
                $ore_seminar = $rr_lende['ore_seminar'];
                $ore_lab = $rr_lende['ore_lab'];
              
            ?>
                <tr>
                    <td><?php echo $emer_l ?></td>
                    <td><?php echo $ore_leksion ?></td>
                    <td><?php echo $ore_seminar ?></td>
                    <td><?php echo $ore_lab ?></td>
                    <td>
                        <form action="../../model/fshilende.php" method="post">
                        <input type="hidden" name="id_lende" id="id_lende" value=<?php echo $id_lende ?>>
                        <button type="submit" name="fshi_lende" id="fshi_lende" ><i class="fas fa-trash"></i></button>
                    </form>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
            </table>
            <form action="../../model/shtolend.php" method="post">
                <input type="hidden" name="dege_id" id="dege_id" value=<?php echo $id_dege ?>>
                <input type="hidden" name="viti" id="viti" value=<?php echo $viti ?>>
                <input type="text" name="emer_lende" id="emer_lende" placeholder="Emri:">
                <input type="text" name="ore_leksion" id="ore_leksion" placeholder="Ore leksione:">
                <input type="text" name="ore_seminar" id="ore_seminar" placeholder="Ore seminar:">
                <input type="text" name="ore_lab" id="ore_lab" placeholder="Ore laborator:">
                <input type="submit" name="shto_lend" id="shto_lend" value="Shto Lende">
            </form>
            <?php }  ?>
    </div>
    <?php  
        }
        mysqli_close($conn);
    ?>
    </div>
    
    
       
    </body>
</html>