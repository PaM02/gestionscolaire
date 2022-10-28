<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Document sans nom</title>
</head>

<body>
<?php
include('parametres_connection.php');

$query="select * from sgs_unit�_enseignement";

$res=sqlsrv_query($conn,$query);

?>


<table width="349" border="1">
<form id="form1" name="form1" method="post" action="traitement.php">
  <tr>
    <td>Libell� UE </td>
    <td>
      <input type="text" name="libelle" />
    </td>
  </tr>
  <tr>
    <td>Code UE </td>
    <td>
      <input type="text" name="codeUE" />
    </td>
  </tr>
  <tr>
    <td>UE</td>
    <td><select name="codeUE">
		<option>--Selectionner un UE--</option>
		<?php
		while($ligne=sqlsrv_fetch_array($res))
		{
			echo "<option value='".$ligne["code"]."'>".$ligne["libell�"]."</option>";			
		}
		?>
		</select>
    </td>
  </tr>
  <tr>
    <td name="ajouter">
        <input type="submit" name="Submit" value="Ajouter" />
    </td>
  </tr>
  </form>
</table>

<?php
//tester si le formulaire est envoy� avant d'effectuer des traitements
if (isset($_POST["codeUE"]))
{
	echo $_POST["codeUE"];

}


?>


<?php

//afficher le contenue de la table sgs_classe
		echo "Mati�re bien ins�s�e. <br> <br>  <br>";
		$query2="select * from sgs_matiere";
		$res=sqlsrv_query($conn,$query2);

		// parcourir l'ensemble des lignes renvoy�es
		//var_dump($res);
		echo "<table border='2'>";
		echo "<td><strong>Unit� enseignement</strong></td>";
		echo "<td><strong>Code mati�re</strong></td>";
		echo "<td><strong>Libell� mati�re</strong></td>";
		while($ligne=sqlsrv_fetch_array($res))
		{

			echo"
			<tr>
				<td> ".$ligne["sgs_unit�_enseignement_code"]." "."</td>
				<td> ".$ligne["code"]." "."</td>
				<td width='200'> ".utf8_encode($ligne["libell�_matiere"])." "."</td>
			
				<td><a href='?codeM=".$ligne["code"]."&action=M'>Modifier</a></td>
        <td>
          <a href='?codeM=".$ligne["code"]."&action=S' onclick=\"return confirm('Etes-vous certain de vouloir supprimer ?');\">Supprimer</a>
        </td>
			</tr>";
			
		}
		echo "</table>";
		
	
//delcaration de variables contenant les valeurs par d�faut du formulaire

$codeUE_Defaut="";
$codeMat_Defaut="";
$nomMat_Defaut="";

$codeMat_readonly="";
$text_submit_button="Ajouter";
	
if (isset( $_GET["codeM"] ) && isset( $_GET["action"] ) ) //variables transmises par GET
{
  //tester la valeur de la variable $_GET["action"] 
  if ($_GET["action"] == "S") //Suppression
  {
    //=========DEBUT SUPPRESSION
    $querySup = "delete from sgs_matiere where code = '".$_GET["codeM"]."' "; //suppression physique
    //$querySup = "update sgs_matiere set est_supprime='1' where code = '".$_GET["codeM"]."' "; //suppression logique
    $resSup = sqlsrv_query($conn,$querySup);
    if ($resSup) 
    {
      echo"<p>Matiere bien supprim�e</p>";
    }
    //=========FIN SUPPRESSION
  }
  else if ($_GET["action"] == "M") //Modification
  {
    //=========DEBUT RECUPERATION INFOS MATIERE
    $codeMat_readonly="readonly";
    $text_submit_button="Modifier";

    //recuperer les informations de la mati�re � modifier et pr�charger les champs du formulaire
    $queryInfo = "select * from sgs_matiere where code = '".$_GET["codeM"]."' ";
    $resInfo = sqlsrv_query($conn,$queryInfo);
    while ($ligne = sqlsrv_fetch_array($resInfo)) 
    {
      $codeUE_Defaut = $ligne["sgs_unit�_enseignement_code"];
      $codeMat_Defaut = $ligne["code"];
      $nomMat_Defaut = utf8_encode($ligne["libelll�"]);

    }
    //=========FIN RECUPERATION INFOS MATIERE
  }
}
		


?>


</body>
</html>
