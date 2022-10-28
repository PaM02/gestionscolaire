<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
 <link rel="stylesheet" href="../css/login.css" />
<title>Connexion</title>

<script language="javascript">
	
	/*
	Fonction javscript qui verifie que le formulaire de connexion est bien rempli avant envoi
	*/
	function verifForm() 
	{
	  var login = document.getElementById("login").value;
	  var pwd = document.getElementById("mot_de_passe").value;
	  	pwd=pwd.trim();
	  	login=login.trim();

	  if (login == "" || pwd == "") 
	  {
	    alert("Veuillez saisir vos paramètres de connexion.");
	    return false;
	  }
	  else
	  {
	  	//alert("Login = " + login);
	  	return true;
	  }
	  	
	}
</script>

</head>

<body>

<?php
include("../php/connection.php");

/*====================================
    DEBUT SCRIPT DE CONNEXION
=====================================*/
if ( isset( $_POST["login"] ) ) 
{
	//verifier si les paramètres saisies existent dans la base
	$query = "select * from utilisateur where login = '".$_POST["login"]."' and mot_de_passe = '".$_POST["mot_de_passe"]."' ";
	$res = sqlsrv_query($conn,$query);
	//echo $query;

	
	if ($res === false) 
	{
		die( print_r( sqlsrv_errors(), true));
	}
	else
	{
		//Le login et le mot de passe saisies exitent dans la table UTILISATEUR.
		//On garde Les colonnes (login, prenom et nom) dans des variables de sessions afin de pouvoir les utiliser plutard

		//toujours démarrer la session avant de pouvoir stocker ou extraires des variables de session
		session_start();
		$existe=0;
		while ($ligne = sqlsrv_fetch_array($res)) 
	    {
	      $_SESSION['login'] = $ligne['login'];
	      $_SESSION['prenom'] = $ligne['prenom'];
	      $_SESSION['nom'] = $ligne['nom'];
	      $existe = 1;
	    }

		if ($existe == 1) //test si cette variable n'est pas vide
		{
		    //Rediriger automatiquement l'utilisateur vers la page d'accueil (index.php)
		    header('Location: index.php');
		}
		else
		{
			//Le login et le mot de passe saisies n'exitent pas dans la table UTILISATEUR.
			//afficher un message à l'utilisateur
			echo'<font color="#FF0000"><h1>Les param&egrave;tres saisis sont incorrects</h1></font>';
		}

	}
	

}
/*====================================
    FIN SCRIPT DE CONNEXION
=====================================*/
?>


<div class="loginbox">
		
		<img src="../image/logo.png" class="avatar">
		<br>
<h1>Connecter Vous </h1>

<form action="../php/login.php" method="post" name="frmLogin" onsubmit="return verifForm()" >

	<p>Nom d'utilisateur</p>
	<input name="login" type="text" id="login" placeholder="Votre login..." />

	<p>Mot de Passe</p>
	<input name="mot_de_passe" type="password" id="mot_de_passe" placeholder="Saisir votre mot de passe" />

	<input type="submit" name="Submit" value="Se connexion" />
	<a href="#">Mot de passe Oublier</a><br>
	<a href="#">Je n'ai pas de compte</a><br>
  
</form>
</div>
</body>
</html>
