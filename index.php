<?php
session_start();

if (!isset($_SESSION['prenom']))
{
	header('Location: login.php'); 
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> Gestion scolaire : accueil</title>
</head>

<body>

<?php
	//test si l'utilisateur a cliqué sur le lien Déconnexion
	if (isset( $_GET["deconnect"] ) ) 
	{
		
		session_start();
		//suppression de toutes les variables stockées dans la session
		session_destroy();
		//redirection de l'utilisateur vers la page de connexion
		header('Location: login.php'); 
	}

?>


<p>

<?php
	//affichage du prenom et du nom de l'ulisateur connecté
	//toujours démarrer la session avant de pouvoir stocker ou extraires des variables de session
	echo'Vous êtes connectés : '.$_SESSION['prenom'].' '.$_SESSION['nom'];
?>
</p>


<p>Exemple de menu : <a href="addClasse2.html">Classe</a> &nbsp;|&nbsp; <a href="addMatieres.php">Mati&egrave;res</a> &nbsp;|&nbsp; <a href="index.php?deconnect=1">D&eacute;connexion</a>  </p>
</body>

</html>
