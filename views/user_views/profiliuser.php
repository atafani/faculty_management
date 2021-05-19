<?php 
    require("user_navbar.php");
    require("../../model/lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>My Profile</title>
        <style type="text/css">
            <?php include("../styles/profili.css") ?>
        </style>
    </head>
    <body style="margin-top:3em;">
    <div class="container">
        <?php 
        $email_p = $_SESSION['email'];
        $username = $_SESSION['username'];
        $roli = $_SESSION['roli'];
        $id = "";
        $emer = "";
        $mbiemer = "";

        if($roli == "pedagog"){
            $query_pedagog = "SELECT emer_pdg,mbiemer_pdg,departament.emer_dep FROM pedagog JOIN departament ON pedagog.dep_id = departament.id_dep WHERE email_pdg = '$email_p'";
            $rezultati_pedagog = mysqli_query($conn, $query_pedagog);

            $rr_pedagog = mysqli_fetch_assoc($rezultati_pedagog);
            $emer = $rr_pedagog['emer_pdg'];
            $mbiemer = $rr_pedagog['mbiemer_pdg'];
            $emer_dep = $rr_pedagog['emer_dep'];
        }else if($roli == "student"){
            $query_student = "SELECT emer_std,mbiemer_std,email_std,grup.emer_grup,grup.viti,dege.emer_dege,dege.cikel FROM student JOIN grup ON student.grup_id = grup.id_grup JOIN dege ON grup.dege_id = dege.id_dege WHERE email_std = '$email_p'";
            $rezultati_student = mysqli_query($conn, $query_student);
            if(!$rezultati_student){
                die();
            }
            $rr_student = mysqli_fetch_assoc($rezultati_student);
            $emer = $rr_student['emer_std'];
            $mbiemer = $rr_student['mbiemer_std'];
            $emer_dege = $rr_student["cikel"] ." ne " .$rr_student['emer_dege'];
            $viti = $rr_student['viti'];
            $emer_grup = $rr_student['emer_grup'];
        }
        ?>
         
        <div class="profili">
            <div class="tedhena_personale">
                <p class="emer_mbiemer"><span>Name:</span> <?php echo $emer ." " .$mbiemer ?></p>
                <p class="username"><span>Username:</span><?php echo $username ?></p>
                <p class="email"><span>E-mail:</span><?php echo $email_p ?></p>
                <?php 
                    if($roli == "pedagog"){
                ?>
                        <p class="departamenti"><span>Departamenti:</span><?php echo $emer_dep ?></p>
                <?php
                    }else{
                ?>
                    <p class="dega"><span>Course:</span><?php echo $emer_dege ?></p>
                    <p class="viti"><span>Year:</span><?php echo $viti ?></p>
                    <p class="grupi"><span>Group:</span><?php echo $emer_grup ?></p>
                <?php
                    }
                ?>
                
            </div>
           
           <button id="ndrysho_fjalekalim_btn">
                Change Password
           </button>
            <form action="../../model/ndryshofjalekalim.php" method="post" class="ndrysho_fjalekalim_form" id="ndrysho_fjalekalim_form">
                <input type="hidden" name="email_p" id="email_p" value=<?php echo $email_p ?>>
                <input type="hidden" name="roli" id="roli" value=<?php echo $roli ?>>
                <input type="password" name="fjalekalimi_ri" id="fjalekalimi_ri" placeholder="Fjalekalimi i ri">
                <input type="submit" name="ndrysho_fjalekalim" id="ndrysho_fjalekalim" value="Ndrysho">
            </form>
        </div>
        <div class="fakulteti">
            <img src="../images/ftiwhite.png" alt="">
        </div>
        </div>
    <?php  
        mysqli_close($conn);
    ?>
    <script type="text/javascript" src="../../controllers/ProfiliUserController.js"></script>
    </body>
</html>