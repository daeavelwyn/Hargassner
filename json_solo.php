<?php
//appelé par ajax, recoit 1 seul channel en parametre et renvoi la serie de data

require_once("conf/config.inc.php");
 

	header("Content-type: text/json");

    $channel = $_GET["channel"];
 
    $query = "SELECT dateB,$channel FROM data
              ORDER by dateB DESC LIMIT 2880";
              
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
        $liste[] = [$dateD, $data[1]];
    }

    echo json_encode(array_reverse($liste), JSON_NUMERIC_CHECK);
    
    

?>
