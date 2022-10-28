<?php

    //synthaxe php pour se connecter a la base SQL SERVER

$serverName = "DESKTOP-MLQ821J\MY_INSTANCE";
//$connectionInfo=$array("Database"=>"BD_GSC","UID"=>"sa","PWD"=>"motdepasse");
$connectionInfo["Database"]="BD_GSC";
$connectionInfo["UID"]="sa";
$connectionInfo["PWD"]="motdepasse";

//appel de la fonction sqlsrv_connect pour se connecter

$conn = sqlsrv_connect($serverName,$connectionInfo);

//tester si la connection passe
if($conn)
{
	echo "Connection établie.<br/>";
}
else
{
	echo"Connection échouée.<br/>";
	//afficher l'erreur sql et arreter l'execution de la page
	die(print_r(sqlsrv_errors(),true));
}

?>