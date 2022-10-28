<?php

//Syntaxe PHP pour se connecter à la base SQL Server
$serverName="DESKTOP-FGJJ6TJ\SQL_ITS4";
//$connectionInfo=
				//$array("Database"=>"BD_GSC",
				//"UID"=>"sa",
				//"PWD"=>"passer");
				
$connectionInfo["Database"]="BD_SGS";
$connectionInfo["UID"]="sa";
$connectionInfo["PWD"]="passer";
	
$conn=sqlsrv_connect($serverName,$connectionInfo);
				
// Tester si la connection marche
if($conn)
{
	echo "Connexion établie.<br/>";
	}
else
{
	echo "Connexion echouée.<br/>";
	// die(print_r(sqlsrv_errors(),true));  arrete 'excution de la page
	
}


?>