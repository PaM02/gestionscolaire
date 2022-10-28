
<?php
  
  session_start();
  //tester si l'utilisateur n'est pas connecter
  if(!isset($_SESSION['prenom']))
  {
    //redirection de l'utilisateur veers la page de connection
    header('Location: ../php/login.php');
  }
  
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" href="../css/index.css" />
<title>Gestion scolaire : accueil</title>
</head>

<body>

<?php
	//test si l'utilisateur a cliqué sur le lien Déconnexion
	if (isset( $_GET["deconnect"] ) ) 
	{
		
		//session_start();
		//suppression de toutes les variables stockées dans la session
		session_destroy();
		//redirection de l'utilisateur vers la page de connexion
		header('Location: ../php/login.php'); 
	}

?>

			<header>
                <div id="titre_principal">
                    <div id="logo">
                        <img src="../image/logo.png" alt="Logo" />
                        
                        Bienvenue Monsieur/Madame

                        <h1>
                        	<?php
	//affichage du prenom et du nom de l'ulisateur connecté
	//toujours démarrer la session avant de pouvoir stocker ou extraires des variables de session
	//session_start();
						echo ' '.$_SESSION['prenom'].' '.$_SESSION['nom'];
							?>
								
						</h1>    
                    </div>
                    <h2> <em>ensae-dakar</em></h2>  
                </div>
                
                <nav>
                    <ul>
                        <li><a href="../html/addclass.html">Classe</a></li>
                        <li><a href="../php/addMatiere.php">Mati&egrave;res</a></li>
                        <li><a href="../php/index.php?deconnect=1">D&eacute;connexion</a></li>
                    </ul>
                </nav>
            </header>

<center>

<p>
<?php
	//affichage du prenom et du nom de l'ulisateur connecté
	//toujours démarrer la session avant de pouvoir stocker ou extraires des variables de session
	//session_start();
    
	echo 'Vous êtes connectés en tant que :  '.$_SESSION['statute'] ;
 
?>
</p>

</center>

<br>
<br>
</body>
    <footer>
                <div id="pol">
                   <center><em>Consulter les pages de l'ecole</em></center> 
                   <br>
                </div>
                <div id="conteneur">
                    <a href="https://www.facebook.com"><img src="../image/facebook.png" alt="Facebook" /></a>
                    <a href="https://www.twitter.com"><img src="../image/twitter.png" alt="Twitter" /></a>
                    <a href="https://www.vimeo.com"><img src="../image/vimeo.png" alt="Vimeo" /></a>
                    <a href="https://www.flickr.com"><img src="../image/flickr.png" alt="Flickr" /></a>
                    <a href="https://www.rss.com"><img src="../image/rss.png" alt="RSS" /></a>
                </div>
                

            </footer>



</html>
