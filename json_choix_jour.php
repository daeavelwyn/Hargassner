<?php
// appelé par ajax, reçoit 1 journée en parametre et renvoi les series de data
require_once("conf/config.inc.php");
 

	header("Content-type: text/json");

    $param =  $_GET["channel"];
    $jour = date('Y-m-d', $param/1000); # /1000 car le timestamp php est en seconde et javascript en ms
    
//valeur pour nanoPK
/*$query = "SELECT dateB,c23,c21,c3,c6,c138,c134,c56 FROM data
          WHERE dateB BETWEEN '".$jour."' AND '".$jour."' + INTERVAL 1 DAY";
*/

//valeur pour Classic 15
$query = "SELECT dateB,c56,c57,c15,c16,c58,c8,c56 FROM data
          WHERE dateB BETWEEN '".$jour."' AND '".$jour."' + INTERVAL 1 DAY";

/*Connexion à la BDD*/
  $link=mysqli_connect($hostname, $username,$password,$database);
   /* Verification de la connexion */
    if (mysqli_connect_errno()) 
    {
        printf("echec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }
    $req = mysqli_query($link,$query) ;
	mysqli_close($link);
    
    while($data = mysqli_fetch_row($req)){
        $dateD = strtotime($data[0]) * 1000;
        $liste1[] = [$dateD, $data[1]];
        $liste2[] = [$dateD, $data[2]];
        $liste3[] = [$dateD, $data[3]];
        $liste4[] = [$dateD, $data[4]];
        $liste5[] = [$dateD, $data[5]];
        $liste6[] = [$dateD, $data[6]];
        $liste7[] = [$dateD, $data[7]];
    }

    $tableau = [$liste1,$liste2,$liste3,$liste4,$liste5,$liste6,$liste7];
    echo json_encode($tableau, JSON_NUMERIC_CHECK);
?>
