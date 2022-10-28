<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Traitement classe</title>
</head>

<body>
<!--Ouverture de la balise php pour le traitement du formulaire-->
<?php
//le contenu du formulaire se trouve dans une variable $_POST

//affichage du contenu du tableau
//var_dump($_POST)

//declarer variable pour affichier le code et le nom de la classe

$data="code = ".$_POST["codeClasse"];
$data= $data." <br> Nom = ".$_POST["nomClasse"];

echo $data;

/* creer une variable $querynqui contient la requete SQL pour inserer une classe

INSERT INTO sgs_classe (code,nom) values ('vcode','vNom')
*/

$codeClasse = $_POST["codeClasse"];
$nomClasse = $_POST["nomClasse"];
$query="INSERT INTO sgs_classe (code,nom,id_user) values ('".$_POST["codeClasse"]."','".$_POST["nomClasse"]."','0')";

echo "<br>".$query;

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

$resultat = sqlsrv_query($conn,$query);
//tester si la requete est bien executer 
if($resultat===false)
{
	echo "Erreur d'execution de la requete";
	die(print_r(sqlsrv_errors(),true));
}
else{

	//afficher le contenu de la table sgs_classe
	echo "Classe bien insérée";
	$query2 = "select * from sgs_classe";
	$res = sqlsrv_query($conn,$query2);

	// parcourir l'ensemble des lignes renvoyées
	var_dump($res);//renvoie le type de resultat





	while($ligne = sqlsrv_fetch_array($res))
	{
		echo "<option value ='".$ligne["code"]."'>".utf8_encode($ligne["libelle"])."</option>";
	}

}

?>
</body>
</html>
