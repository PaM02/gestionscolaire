<?php
  
  session_start();
  //tester si l'utilisateur n'est pas connecter
  if(!isset($_SESSION['prenom']))
  {
    //redirection de l'utilisateur veers la page de connection
    header('Location: login.php');
  }
  
?>





<!DOCTYPE html>
<html>
    <head>
        
        <title>about</title>
    </head>
	
	<body>
    <?php
    //appel du fichier contenant les parametres de connection

    include("../php/connection.php");

    $queryUE="select * from sgs_unite_enseignement";
    $res = sqlsrv_query($conn,$queryUE);








/*====================================
    DEBUT SCRIPT MODIFICATION ou SUPPRESSION D'UNE MATIERE
=====================================*/

//delcaration de variables contenant les valeurs par défaut du formulaire
$UE_Defaut="";
$codemat_Defaut="";
$libmat_Defaut="";

$codemat_readonly="";
$text_submit_button="Ajouter";

if (isset( $_GET["codemat"] ) && isset( $_GET["action"] ) ) //variables transmises par GET
{
  //tester la valeur de la variable $_GET["action"] 
  if ($_GET["action"] == "S") //Suppression
  {
    //=========DEBUT SUPPRESSION
    $querySup = "delete from sgs_matiere where code = '".$_GET["codemat"]."' "; //suppression physique
    //$querySup = "update sgs_matiere set est_supprime='1' where code = '".$_GET["codeM"]."' "; //suppression logique
    $resSup = sqlsrv_query($conn,$querySup);
    if ($resSup) 
    {
      echo"<p>Matiere bien supprimée</p>";
    }
    //=========FIN SUPPRESSION
  }
  else if ($_GET["action"] == "M") //Modification
  {
    //=========DEBUT RECUPERATION INFOS MATIERE
    $codemat_readonly="readonly";
    $text_submit_button="Modifier";

    //recuperer les informations de la matière à modifier et précharger les champs du formulaire
    $queryInfo = "select * from sgs_matiere where code = '".$_GET["codemat"]."' ";
    $resInfo = sqlsrv_query($conn,$queryInfo);
    while ($ligne = sqlsrv_fetch_array($resInfo)) 
    {
      $UE_Defaut = $ligne["sgs_unite_enseignement_code"];
      $codemat_Defaut = $ligne["code"];
      $libmat_Defaut = utf8_encode($ligne["libelle"]);

    }
    //=========FIN RECUPERATION INFOS MATIERE
  }
}


/*====================================
    FIN SCRIPT MODIFICATION ou SUPPRESSION D'UNE MATIERE
=====================================*/

//traitement du formulaire


//tester si le formulaire est envoyé avant d'effectuer les traitements
/*====================================
    DEBUT SCRIPT D'AJOUT D'UNE MATIERE
=====================================*/
if ( isset( $_POST["UE"] ) ) 
{
   //var_dump($_POST);
    

    $nomM = str_replace("'","''",$_POST["libmat"]);

    if ($_POST["Submit"] == "Ajouter") 
    {
      $query = "INSERT INTO sgs_matiere (code,sgs_unite_enseignement_code,libelle) values ('".$_POST["codeMatiere"]."','".$_POST["codeUE"]."','".$nomM."')";
    }
    else
    {
      $query = "UPDATE sgs_matiere set sgs_unite_enseignement_code = '".$_POST["codeUE"]."', libelle = '".$nomM."' where code ='".$_POST["codeMatiere"]."'";
    }

    

    //echo "<br>".$query."<br>";

    $resultat = sqlsrv_query($conn,$query);

    //tester si la requete est bien executée
    if ($resultat === false) 
    {
      echo"Erreur d'execution de la requête";
      die( print_r( sqlsrv_errors(), true));
    }
    else
    {
      echo"Matière bien enregistrée.";
      //echo"Matière bien ajoutée.";

      //vider les champs du formulaire
      $codeUE_Defaut="";
      $codeMat_Defaut="";
      $nomMat_Defaut="";
    }
    
    

}
/*====================================
    FIN SCRIPT D'AJOUT D'UNE MATIERE
=====================================*/
?>
























    ?>
		<div >

			<header>
            </header>
            <section id ="page2">
                <MARQUEE BEHAVIOR="alternate" WIDTH="100%" LOOP="-1" > <p class="titre1"><h1> Veillez renseigner les informations suivantes pour ajouter une matiére </h1>  </p> </MARQUEE> 
                
                    <form method="post" >
                        <fieldset>
                            <legend >VEILLEZ RENSEIGNER LA MATIERE</legend> <!-- Titre du fieldset --> 


                                <p>
                                <label for="UE">Unité d'enseignement : </label>
                                    <select name="UE" id="UE">
                                        <?php
                                            while($ligne = sqlsrv_fetch_array($res))
                                            {
                                                //parcourir le resultat de la requete
                                               // var_dump($ligne);
                                                echo "<option value ='".$ligne["code"]."'>".utf8_encode($ligne["libelle"])."</option>";
                                            }
                                        ?>
                                    </select>
                                 </p>

                            <p><label for="codemat" > CODE MATIERE </label>
                            <input type="text" name="codemat" id="codemat"  maxlength="50"  /></p>

                            <p><label for="libmat">LIBELLE</label>
                            <input type="text" name="libmat" id="libmat"  maxlength="50"  /></p> 

                                <div >
                                    <button type="submit">Soumettre </button>
                                </div>
                        </fieldset>
                         

                    </form>
                    <br />
                </section>
            </div>
<?php
    //traitement du formulaire
    //tester si le formulaire est envoye avant d'effectuer les traitements
    if(isset($_POST["UE"])){
        echo $_POST["UE"];

        //declarer variable pour affichier le code et le nom de la classe

$data="UE = ".$_POST["UE"];
$data= $data." <br> codematiere = ".$_POST["codemat"];
$data= $data." <br> libmat = ".$_POST["libmat"];
echo $data;

/* creer une variable $querynqui contient la requete SQL pour inserer une classe

INSERT INTO sgs_matiere (code,nom) values ('vcode','vNom')
*/

$query="INSERT INTO sgs_matiere (code,sgs_unite_enseignement_code,libelle) values ('".$_POST["codemat"]."','".$_POST["UE"]."','".$_POST["libmat"]."')";


 $resitution = sqlsrv_query($conn,$query);

}


/*====================================
DEBUT SCRIPT D'AFFICHAGE DES MATIERES
=====================================*/

  //requête pour extraire la liste des matières
  $query="select m.* , u.libelle as libelleUE 
          from sgs_matiere m
          join sgs_unite_enseignement u
          on m.sgs_unite_enseignement_code = u.code 
          order by u.libelle ";

  //execution de la requête
  $res = sqlsrv_query($conn,$query);

  //parcourir l'ensemble des lignes renvoyées
  echo'<p><strong> LISTE DES MATIERES </strong></p>';
  echo"<table border='1' width='80%' cellspacing='5' cellpadding='5'>";
  echo"<tr>
      <th>Unité d'enseignement</th>
      <th>Code Matière</th>
      <th>Matière</th>
      <th colspan='2'></th>
    </tr>";
  while ($ligne = sqlsrv_fetch_array($res)) 
  {
    echo"<tr>
        <td>".utf8_encode($ligne["libelleUE"])."</td>
        <td>".$ligne["code"]."</td>
        <td>". utf8_encode($ligne["libelle"])."</td>
        <td><a href='?codeM=".$ligne["code"]."&action=M'>Modifier</a></td>
        <td>
          <a href='?codeM=".$ligne["code"]."&action=S' onclick=\"return confirm('Etes-vous certain de vouloir supprimer ?');\">Supprimer</a>
        </td>
      </tr>";

  }
  echo"</table>";

/*====================================
FIN SCRIPT D'AFFICHAGE DES MATIERES
=====================================*/
?>
</body>
</html>
