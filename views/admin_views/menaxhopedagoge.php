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
        <title>Menaxho Pedagoge</title>
        <style type="text/css">
            <?php include("../styles/menaxhopedagoge.css") ?>
        </style>
    </head>
    <body style="margin-top:5em;">
    <div class="pedagoget">
    <?php
        $query_dep = "SELECT * FROM departament";

        $rezultati_dep = mysqli_query($conn, $query_dep);

        if(!$rezultati_dep){
            $mesazh = "Nuk u gjenden te dhenat ne baze.";
            die();
        }

        while($rr_dep = mysqli_fetch_assoc($rezultati_dep)){
            $id_dep = $rr_dep['id_dep'];
            $emer_dep  =$rr_dep['emer_dep'];
    ?>
    <div class="departament">
       <p class="emri_dep"><?php echo $emer_dep ?></p>
       <form enctype="multipart/form-data"  action="../../model/shtopedagoge.php" method="post">
            <input type="hidden" name="dep_id" id="dep_id" value=<?php echo $id_dep ?>>
            <input type="file" name="pedagoge_file" id="pedagoge_file" accept=".csv" required >
            <input type="submit" name="shto_pedagoge" id="shto_pedagoge" value="Shto Pedagoge">
       </form>
       <?php
        $query_pedagog = "SELECT id_pedagog,emer_pdg,mbiemer_pdg,email_pdg,perdorues.id_perdorues, perdorues.username, perdorues.fjalekalim, perdorues.roli FROM pedagog JOIN perdorues ON pedagog.email_pdg = perdorues.email_p WHERE pedagog.dep_id = '$id_dep'";

        $rezultati_pedagog = mysqli_query($conn, $query_pedagog);

        if(!$rezultati_pedagog){
            $mesazh = "Nuk u gjenden te dhenat ne baze.";
            die();
        }

        if(mysqli_num_rows($rezultati_pedagog) >= 1 ){
            ?>
            <table class="pedagog_tbl">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Emri</th>
                        <th>Mbiemri</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Fjalekalimi</th>
                        <th>Gjenero Fjalekalim</th>
                        <th>Fshi</th>
                    </tr>
                </thead>
                <tbody>
            <?php
                while($rr_pedagog = mysqli_fetch_assoc( $rezultati_pedagog)){
                    $id_perdorues = $rr_pedagog['id_perdorues'];
                    $roli = $rr_pedagog['roli'];
                    $id_pedagog = $rr_pedagog['id_pedagog'];
                    $emer_pdg = $rr_pedagog['emer_pdg'];
                    $mbiemer_pdg = $rr_pedagog['mbiemer_pdg'];
                    $email_pdg = $rr_pedagog['email_pdg'];
                    $username_pdg = $rr_pedagog['username'];
                    $fjalekalim_pdg = $rr_pedagog['fjalekalim'];
            ?>
            <tr>
                <td><?php echo $id_pedagog ?></td>
                <td><?php echo $emer_pdg ?></td>
                <td><?php echo $mbiemer_pdg ?></td>
                <td><?php echo $email_pdg ?></td>
                <td><?php echo $username_pdg ?></td>
                <td><?php echo $fjalekalim_pdg ?></td>
                <td>
                    <form action="../../model/gjenerofjalekalim.php" method="post">
                        <input type="hidden" name="perdorues_id" id="perdorues_id" value=<?php echo $id_perdorues ?>>
                        <input type="hidden" name="roli" id="roli" value=<?php echo $roli ?>>
                        <button type="submit" name="gjenero_fjalekalim" id="gjenero_fjalekalim"><i class="far fa-edit"></i></button>
                    </form>
                </td>
                <td>
                    <form action="../../model/fshipedagog.php" method="post">
                        <input type="hidden" name="id_pedagog" id="id_pedagog" value=<?php echo $id_pedagog ?>>
                        <input type="hidden" name="id_perdorues" id="id_perdorues" value=<?php echo $id_perdorues ?>>
                        <button type="submit" name="fshi_pedagog" id="fshi_pedagog" ><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            <?php } ?>
                </tbody>
            </table>
            <?php }  ?>
            <form action="../../model/shtopedagog.php" method="post" id="shto_pedagog_form">
                <input type="hidden" name="dep_id" id="dep_id" value=<?php echo $id_dep ?>>
                <input type="text" name="emer_pdg" id="emer_pg" placeholder="Emri:" required>
                <input type="text" name="mbiemer_pdg" id="mbiemer_pg" placeholder="Mbiemri:" required>
                <input type="email" name="email_pdg" id="email_pdg" placeholder="E-mail:" required>
                <input type="submit" name="shto_pedagog" id="shto_pedagog" value="Shto Pedagog">
            </form>
    </div>
    <?php  
        }
    
        mysqli_close($conn);
    ?>
    </div>
    
    
       
    </body>
</html>