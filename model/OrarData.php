<?php
    

    $degeIdName = array();
    $nrGrupe = array();
    $grupeIdName = array();

    $query_dege = "SELECT id_dege, emer_dege FROM dege WHERE cikel = 'Bachelor' ORDER BY id_dege";
    $rezultati_dege = mysqli_query($conn, $query_dege);

    if(!$rezultati_dege){
        $mesazh = "Nuk u gjenden te dhenat ne baze.";
        alert($mesazh);
        die();
    }

    while($rr_dege = mysqli_fetch_assoc($rezultati_dege)){
        $id_dege = $rr_dege['id_dege'];
        $emer_dege = $rr_dege['emer_dege'];
        
        $degeIdName[$id_dege] = $emer_dege;

        $query_vit = "SELECT DISTINCT viti FROM grup WHERE dege_id = '$id_dege' ORDER BY viti ASC";

        $rezultati_vit = mysqli_query($conn, $query_vit);
        if(!$rezultati_vit){
            $mesazh = "Nuk u gjeten te dhenat ne baze.";
            alert($mesazh);
            die();
        }
       while($rr_vit = mysqli_fetch_assoc($rezultati_vit)){
            $viti = $rr_vit['viti'];

            $query_grup = "SELECT id_grup, emer_grup FROM grup  WHERE dege_id = '$id_dege' AND viti = '$viti' ORDER BY emer_grup ASC";

            $rezultati_grup = mysqli_query($conn, $query_grup);

            if(!$rezultati_grup){
                $mesazh = "Nuk u gjeten te dhenat ne baze.";
                alert($mesazh);
                die();
            }
            
            $nr_grupe = mysqli_num_rows($rezultati_grup);
            $nrGrupe[$id_dege][$viti] = $nr_grupe;
            
          
            while($rr_grup = mysqli_fetch_array($rezultati_grup)){
                $id_grup = $rr_grup['id_grup'];
                $emer_grup = $rr_grup['emer_grup'];
                
                $grupeIdName[$id_dege][$viti][$id_grup] = $emer_grup;
             
            }

        }
    }      
    function alert($msg){
        echo "<script type='text/javascript'>alert('$msg');</script>";
    }  
?>
