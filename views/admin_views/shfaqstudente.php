<?php 
    require("admin_navbar.php");
    require("../../model/lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

    $mesazh = "";

    if(isset($_POST['shfaq_std'])){
        if(isset($_POST['grup_id']) && isset($_POST['emer_dege']) && isset($_POST['emer_grup'])) {
            $id_grup = $_POST['grup_id'];
            $emer_dege = $_POST['emer_dege'];
            $emer_grup = $_POST['emer_grup'];
            $_SESSION['grup_id'] = $id_grup;
            $_SESSION['emer_dege'] = $emer_dege;
            $_SESSION['emer_grup'] = $emer_grup;
        }
    }else{
        $id_grup = $_SESSION['grup_id'];
        $emer_dege = $_SESSION['emer_dege'];
        $emer_grup = $_SESSION['emer_grup'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Menaxho Studentet</title>
        <style type="text/css">
            <?php include("../styles/studente.css") ?>
        </style>
    </head>

    <body style="margin-top:5em;">
    <a href="menaxhostudente.php" class="kthehu_pas"><i class="fas fa-arrow-circle-left"></i><?php echo $emer_dege . "-" .$emer_grup ?></a>
    <?php 
            $query_shfaqstd = "SELECT student.id_student,student.emer_std,student.mbiemer_std,student.email_std,perdorues.id_perdorues,perdorues.username,perdorues.fjalekalim, perdorues.roli FROM student JOIN perdorues ON student.email_std = perdorues.email_p WHERE grup_id = '$id_grup' AND  perdorues.roli = 'student'";

            $rezultati_shfaqstd = mysqli_query($conn, $query_shfaqstd);
            
            
            if($rezultati_shfaqstd && mysqli_num_rows($rezultati_shfaqstd) >= 1 ){
                ?>
                <div class="studente">
                <table class="studente_tbl">
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
                    while($rr_shfaqstd = mysqli_fetch_assoc($rezultati_shfaqstd)){
                        $id_perdorues = $rr_shfaqstd['id_perdorues'];
                        $roli = $rr_shfaqstd['roli'];
                        $id_student = $rr_shfaqstd['id_student'];
                        $emer_std = $rr_shfaqstd['emer_std'];
                        $mbiemer_std = $rr_shfaqstd['mbiemer_std'];
                        $email_std = $rr_shfaqstd['email_std'];
                        $username_std = $rr_shfaqstd['username'];
                        $fjalekalim_std = $rr_shfaqstd['fjalekalim'];
                ?>
                <tr>
                    <td><?php echo $id_student ?></td>
                    <td><?php echo $emer_std ?></td>
                    <td><?php echo $mbiemer_std ?></td>
                    <td><?php echo $email_std ?></td>
                    <td><?php echo $username_std ?></td>
                    <td><?php echo $fjalekalim_std ?></td>
                    <td>
                        <form action="../../model/gjenerofjalekalim.php" method="post">
                            <input type="hidden" name="perdorues_id" id="perdorues_id" value=<?php echo $id_perdorues ?>>
                            <input type="hidden" name="roli" id="roli" value=<?php echo $roli ?>>
                            <button type="submit" name="gjenero_fjalekalim" id="gjenero_fjalekalim"><i class="far fa-edit"></i></button>
                        </form>
                    </td>
                    <td>
                        <form action="../../model/fshistudent.php" method="post">
                            <input type="hidden" name="id_student" id="id_student" value=<?php echo $id_student ?>>
                            <input type="hidden" name="id_perdorues" id="id_perdorues" value=<?php echo $id_perdorues ?>>
                            <button type="submit" name="fshi_student" id="fshi_student" ><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
                <?php } ?>

                    </tbody>
                </table>
                </div>
                
            <?php
            }
    
    ?>
    <form action="../../model/shtostudent.php" method="post" id="shto_student_form">
        <input type="hidden" name="grup_id" id="grup_id" value=<?php echo $id_grup ?>>
        <input type="text" name="emer_std" id="emer_std" placeholder="Emri:" required>
        <input type="text" name="mbiemer_std" id="mbiemer_std" placeholder="Mbiemri:" required>
        <input type="email" name="email_std" id="email_std" placeholder="E-mail:" required>
        <input type="submit" name="shto_std" id="shto_std" value="Shto Student">
    </form>
    
    <?php
        mysqli_close($conn);
    ?>
       
    </body>
</html>
