<?php
/**
* ce script permet de peupler la base de donnees poour verifier les 
* autres scripts ensuite
**/
header("Content-type: text/json");
require_once("conf/config.inc.php");

/*Connexion à la BDD*/
$link=mysqli_connect($hostname, $username,$password,$database);
/* Verification de la connexion */
if (mysqli_connect_errno()) 
{
	printf("echec de la connexion : %s\n", mysqli_connect_error());
	exit();
}

/* generation des dates de la periode $data[0]*/
$begin = new DateTime( '2020-09-01' );
$end = new DateTime( '2020-12-31' );
$end = $end->modify( '+1 day' );
$interval = new DateInterval('P1D');
$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
	/* formatage des donnees random*/
	$data[0]=$date->format("Y-m-d")."\n";//DEBUG
	$data[1]=$conso=rand(0,50)."\n";//DEBUG
	$data[2]=$Tmoy=rand(0,25)."\n";//DEBUG
	
	/*insertion données*/
	$SQLinsert = "INSERT INTO consommation (dateB, conso, Tmoy) VALUES ('$data[0]',$data[1],$data[2])" ;
	if(!mysqli_query($link,$SQLinsert))
	{
		printf("Message d'erreur : %s\n", mysqli_error($link));
	}
}
?>