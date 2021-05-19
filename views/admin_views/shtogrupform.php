
<form enctype="multipart/form-data" action="../../model/shtogrup.php" method="post">
    <input type="hidden" name="dege_id" id="dege_id" value=<?php echo $id_dege ?>>
    
    <input type="file" name="studente_file" id="studente_file" accept=".csv">

    <select name="viti_id" id="viti_id">
        <?php
            $query_viti = "SELECT * FROM viti WHERE dege_id = '$id_dege'";
            $rezultati_viti = mysqli_query($conn, $query_viti);

            if(!$rezultati_viti){
                $mesazh = "Nuk u gjenden te dhenat ne baze.";
                die();
            }
            
            while($rr_v = mysqli_fetch_assoc($rezultati_viti)){
                $id_viti = $rr_v['id_viti'];
                $emri_vit = $rr_v['emri_vit'];
        ?>
        <option value=<?php echo $id_viti ?>><?php echo $emri_vit ?></option>
        <?php } ?>
    </select>
    <select name="emri_grid" id="emri_grid">
    <?php 
        $query_emergr = "SELECT * FROM emer_grupi";
        $rezultati_emergr = mysqli_query($conn, $query_emergr);
        if(!$rezultati_emergr){
            die();
        }
        while($rr_emergr = mysqli_fetch_assoc($rezultati_emergr)){
            $id_emergr = $rr_emergr['id_emergr'];
            $emer_gr = $rr_emergr['emer_gr'];
    ?> 
            <option value=<?php echo $id_emergr ?>><?php echo $emer_gr ?></option>
        <?php
        }
    ?>
    </select>
    <input type="submit" name="shto_grup" id="shto_grup" value="Shto Grup">
</form>