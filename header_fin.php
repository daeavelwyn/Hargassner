</head>

<body>
    <?php
    // **********recherche nouvelle version******************************
    require_once("conf/config.inc.php");
    // $version = 1.0;// debug
    $config_github = fopen('conf/config.inc.php', 'r'); //debug
    // $config_github = fopen('https://raw.githubusercontent.com/Jahislove/Hargassner/master/conf/config.inc.php', 'r'); 
    if ($config_github) {
        while (!feof($config_github)) {
            $ligne = fgets($config_github); //lit chaque ligne du fichier
            $ligne_version = strstr($ligne,'version'); //recherche la chaine 'version'
            if ($ligne_version) {
                $version_github = floatval(explode('=',$ligne_version)[1]); // explode en champ, et extrait la valeur decimal du champ 1
                break;
            }
        }
        fclose($config_github);
    }

    if ($version < $version_github) {
        echo '<div id="new_version">';
        echo 'Nouvelle version disponible : '.$version_github.' - <a href="notes_version.txt">Notes de version</a> - <a href="auto-install.php">Installation</a>';
        echo '</div>';
    }
    // ******************************************************************
    ?>

	<nav>
        <ul class="fancyNav">
            <li id="home">   <a href="index.php" class="homeIcon">Accueil</a></li>
            <li id="chart">  <a href="page_1_24h.php">Régulation</a></li>
            <li id="chart2"> <a href="page_2_courbes.php">Variables</a></li>
            <li id="chart3"> <a href="page_3_conso.php">Consommation</a></li>
            <li id="about">  <a href="about.php">a propos</a></li>
        </ul>
	</nav>
    
<div id="etat">?</div>
