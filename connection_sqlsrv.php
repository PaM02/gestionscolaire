<?php
//syntaxe php pour se connecter à la base SQl SERVER

$serverName="DESKTOP-FGJJ6TJ\SQL_ITS4";
/*	$connectingINFO=$array("Database"=>"ITSdb",
						"UID"=>"sa",
						"PWD"=>"passer");
*/

$connectingINFO["Database"]="BD_SGS";
$connectingINFO["UID"]="sa";
$connectingINFO["PWD"]="passer";
//appel de la function sqlsrv_connect pour se connecter a la base
$conn=sqlsrv_connect($serverName,$connectingINFO);
//tester si la connection passe
if($conn){
	echo "Connexion établie.<br>";
}else{
	echo "Connexion échouée.<br>";
	//afficher l'erreur sql et arreter l'execution de la page
	die(print_r(sqlsrv_errors(),true));
}
?>