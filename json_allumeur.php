<?php
//appelé par ajax, 

require_once("conf/config.inc.php");
 

	header("Content-type: text/json");
                // select DATE(dateB), SUM(c0) FROM(
                // select dateB,c0/5 as c0 from data

    $query1 = "
                select DATE(dateB), count(c0) FROM(
                select dateB,c0 from data
                where dateB > DATE_SUB(NOW(), INTERVAL 30 DAY) AND c0 = '5'
                GROUP by DATE(dateB),HOUR(dateB)  
                ) as tmp
                GROUP BY DATE(dateB)";

  $link=mysqli_connect($hostname, $username,$password,$database);
	
	/* Verification de la connexion */
    if (mysqli_connect_errno()) 
    {
        printf("echec de la connexion : %s\n", mysqli_connect_error());
        exit();
    }
    $req1 = mysqli_query($link,$query1) ;
	mysqli_close($link);
    
    while($data = mysqli_fetch_row($req1)){
        $dateD = strtotime($data[0]) * 1000;
        // $dateD = (strtotime($data[0])+ 10000) * 1000;
        $liste1[] = [$dateD, $data[1]];
    }

   echo json_encode($liste1, JSON_NUMERIC_CHECK);
   
    

?>
