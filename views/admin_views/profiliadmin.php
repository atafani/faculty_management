<?php 
    require("admin_navbar.php");
    require("../../model/lidhja.php");

    $instanceLidhja = LidhjaDB::getInstance();
    $conn = $instanceLidhja->getLidhje();

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Menaxho Orar</title>
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
        

        $query_admin = "SELECT * FROM admin WHERE email_adm = '$email_p'";
        $rezultati_admin = mysqli_query($conn, $query_admin);

        $rr_admin = mysqli_fetch_assoc($rezultati_admin);
        $id = $rr_admin['id_admin'];
        $emer = $rr_admin['emer_adm'];
        $mbiemer = $rr_admin['mbiemer_adm'];

        
        ?>
        
        <div class="profili">
            <div class="tedhena_personale">
                <p class="emer_mbiemer"><span>Emri i plote:</span> <?php echo $emer ." " .$mbiemer ?></p>
                <p class="username"><span>Username:</span><?php echo $username ?></p>
                <p class="email"><span>E-mail:</span><?php echo $email_p ?></p>
            </div>
           <p style="margin:1em 0;font-weight:bold;">Menaxho Admin</p>
            <?php 
                $query_adminplus = "SELECT * FROM admin WHERE email_adm != '$email_p'";
                $rezultati_adminplus = mysqli_query($conn, $query_adminplus);
                
                while($rr_adm = mysqli_fetch_assoc($rezultati_adminplus)){
                    $id_adm = $rr_adm['id_admin'];
                    $emer_adm = $rr_adm['emer_adm'];
                    $mbiemer_adm = $rr_adm['mbiemer_adm'];
                    $email_adm = $rr_adm['email_adm'];

                    ?>
                    <div class="admin">
                        <span><?php echo $emer_adm ." " .$mbiemer_adm ?></span>
                        <form action="../../model/fshiadmin.php" method="post">
                            <input type="hidden" name="id_admin" id="id_admin" value=<?php echo $id_adm ?>>
                            <input type="hidden" name="email_adm" id="email_adm" value=<?php echo $email_adm ?>>
                            <button type="submit" name="fshi_admin" id="fshi_admin" ><i class="fas fa-trash"></i></button>
                        </form>
                    </div>
                    <?php
                }
            ?>
             
            <button id="ndrysho_admin_btn">
                Ndrysho të dhëna
           </button>

            <form action="../../model/ndryshoadmin.php" method="post" class="ndrysho_admin_form" id="ndrysho_admin_form">
                <input type="hidden" name="id_admin" id="id_admin" value=<?php echo $id ?>>
                <input type="text" name="emer" id="emer" placeholder="Emri:" required>
                <input type="text" name="mbiemer" id="mbiemer" placeholder="Mbiemri:" required>
                <input type="email" name="email" id="email" placeholder="E-mail:" required>
                <input type="submit" name="ndrysho_adm" id="ndrysho_adm" value="Ndrysho">
            </form>

           <button id="ndrysho_fjalekalim_btn">
                Ndrysho Fjalekalimin
           </button>
            <form action="../../model/ndryshofjalekalim.php" method="post" class="ndrysho_fjalekalim_form" id="ndrysho_fjalekalim_form">
                <input type="hidden" name="email_p" id="email_p" value=<?php echo $email_p ?>>
                <input type="hidden" name="roli" id="roli" value=<?php echo $roli ?>>
                <input type="password" name="fjalekalimi_ri" id="fjalekalimi_ri" placeholder="Fjalekalimi i ri" required>
                <input type="submit" name="ndrysho_fjalekalim" id="ndrysho_fjalekalim" value="Ndrysho">
            </form>
            
            <button id="shto_admin_btn">
                Shto Admin
            </button>

            <form action="../../model/shtoadmin.php" method="post" class="shto_admin_form" id="shto_admin_form">
                <input type="text" name="emer_adm" id="emer_adm" placeholder="Emri:" required>
                <input type="text" name="mbiemer_adm" id="mbiemer_adm" placeholder="Mbiemri:" required>
                <input type="email" name="email_adm" id="email_adm" placeholder="E-mail:" required>
                <input type="submit" name="shto_adm" id="shto_adm" value="Shto">
            </form>
            
        </div>
        <div class="fakulteti">
            <img src="../images/ftiwhite.png" alt="">
        </div>
        </div>
    <?php  
        mysqli_close($conn);
    ?>
    <script type="text/javascript" src="../../controllers/ProfiliAdminController.js"></script>
    </body>
</html>