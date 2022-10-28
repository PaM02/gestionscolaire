<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Traitement classe</title>
</head>

<body>


<?php

//Affichage du tableau
var_dump($_POST);

//Afficher le code et le nom de la classe
$data="Code=".$_POST["codeClasse"];
$data.="<br>"."Nom=".$_POST["nomClasse"];

echo $data;

//Creer une variable query qui contient a requete pour inserer une classe puis afficher la variable


$code=$_POST["codeClasse"];
$nom=$_POST["nomClasse"];
$query="INSERT INTO sgs_classe(code,nom) values('$code','$nom'),'0'";

//www.connectionstrings.com

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
echo "suite...";


$resultat=sqlsrv_query($conn,$query);

if ($resultat=false)
{
		echo "Erreur d'excution de la requete";
		die(print_r(sqlsrv_errors(),true));
}
else
{
	echo "Classe bien insérée";
	$query2="select*from sgs_classe";
	$res=sqlsrv_query($conn,$query2);
	
	{
		while($ligne=sqlsrv_fetch_array($res))
		{
			echo $ligne["code"]."<br>";			
		}
	}
}





?>
<br />
<?=$query ?>






</body>
</html>
