<?php
/**
* ce script permet de tester la connexion avec la chaudiere
**/
header("Content-type: text/json");
require_once("conf/config.inc.php");

//$IPchaudiere = "192.168.0.251"; //DEBUG
//$port = 23; //DEBUG

    $fp = fsockopen ($IPchaudiere, $port, $errno, $errstr);
    if(!$fp){
        echo "$errstr";
    }
    else {
        $reponse=fgets ($fp,1024); //lecture reponse telnet
        fclose($fp);
	echo "La requte contient: ". $reponse."\n";
	echo "Il y a ".count(explode(" ",$reponse))." entrees dans cette requete\n";
    }
?>
