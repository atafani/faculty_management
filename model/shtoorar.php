<?php
 require("lidhja.php");

 $instanceLidhja = LidhjaDB::getInstance();
 $conn = $instanceLidhja->getLidhje();
if(isset($_POST['shto_orar'])){
        $dege_id = (integer)$_POST['id_dege'];
        $lende_id = (integer)$_POST['lende_id'];
        $pedagog_id = (integer)$_POST['pedagog_id'];
        $dita = (integer)$_POST['dita'];
        $ora_fillimit = (integer)$_POST['ora_fillimit'];
        $ora_mbarimit = (integer)$_POST['ora_mbarimit'];
        $salle_id = (integer)$_POST['salle_id'];

    if(strcmp($_POST['tipi'] ,"leksion") == 0){
            $query_checkleksion = "SELECT * FROM leksion WHERE (ora_fillimit <= '$ora_fillimit' AND ora_mbarimit > '$ora_fillimit' AND salle_id = '$salle_id' AND dita = '$dita') OR (ora_fillimit < '$ora_mbarimit' AND ora_mbarimit >= '$ora_mbarimit' AND salle_id = '$salle_id' AND dita = '$dita')";

            $query_checkseminar = "SELECT * FROM seminar WHERE (ora_fillimit <= '$ora_fillimit' AND ora_mbarimit > '$ora_fillimit' AND grup_id = '$id_grup' AND salle_id = '$salle_id' AND dita = '$dita') OR (ora_fillimit < '$ora_mbarimit' AND ora_mbarimit >= '$ora_mbarimit' AND grup_id = '$id_grup'  AND salle_id = '$salle_id' AND dita = '$dita')";
            
            $rezultati_checkleksion = mysqli_query($conn, $query_checkleksion);
            $rezultati_checkseminar = mysqli_query($conn, $query_checkseminar);
        
            if(mysqli_num_rows($rezultati_checkleksion) == 0 && mysqli_num_rows($rezultati_checkseminar) == 0){
                $query_leksion = "INSERT INTO leksion(dita,ora_fillimit,ora_mbarimit,lende_id,pedagog_id,salle_id) VALUES('$dita', '$ora_fillimit', '$ora_mbarimit', '$lende_id', '$pedagog_id', '$salle_id')";
                $rezultati_leksion =mysqli_query($conn, $query_leksion);
    
                if(!$rezultati_leksion){
                    $mesazh = "Te dhenat e leksionit nuk u ruajten.";
                    alert($mesazh);
                    die();
                }
            }else {
                echo mysqli_num_rows($rezultati_checkleksion);
                echo "    ";
                echo mysqli_num_rows($rezultati_checkseminar) ;
            }
        
    }else if(strcmp($_POST['tipi'], "seminar") == 0){
        $id_grup = $_POST['id_grup'];

        $query_checkleksion = "SELECT * FROM leksion WHERE (ora_fillimit <= '$ora_fillimit' AND ora_mbarimit > '$ora_fillimit'  AND salle_id = '$salle_id' AND dita = '$dita') OR (ora_fillimit < '$ora_mbarimit' AND ora_mbarimit >= '$ora_mbarimit' AND salle_id = '$salle_id' AND dita = '$dita')";

        $query_checkseminar = "SELECT * FROM seminar WHERE (ora_fillimit <= '$ora_fillimit' AND ora_mbarimit > '$ora_fillimit' AND grup_id = '$id_grup' AND salle_id = '$salle_id' AND dita = '$dita') OR (ora_fillimit < '$ora_mbarimit' AND ora_mbarimit >= '$ora_mbarimit' AND grup_id = '$id_grup' AND salle_id = '$salle_id' AND dita = '$dita')";

        $rezultati_checkleksion = mysqli_query($conn, $query_checkleksion);
        $rezultati_checkseminar = mysqli_query($conn, $query_checkseminar);
    
        if(mysqli_num_rows($rezultati_checkleksion) == 0 && mysqli_num_rows($rezultati_checkseminar) == 0){ 
            $query_seminar = "INSERT INTO seminar(dita,ora_fillimit,ora_mbarimit,grup_id, lende_id,pedagog_id,salle_id) VALUES('$dita', '$ora_fillimit', '$ora_mbarimit', '$id_grup', '$lende_id', '$pedagog_id', '$salle_id')";

            $rezultati_seminar= mysqli_query($conn, $query_seminar);

            if(!$rezultati_seminar){
                $mesazh = "Te dhenat e seminarit nuk u ruajten";
                alert($mesazh);
                header("Location: ../views/admin_views/menaxhoorarin.php");
                die();
            }
        }
      
    }
}

header("Location: ../views/admin_views/menaxhoorarin.php");
function alert($msg){
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>