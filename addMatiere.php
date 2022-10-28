<!DOCTYPE html">
<html">
<head>
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Ajout de matière</title>
</head>
<body>
<?php
include("connection_sqlsrv.php");
//extraction de la liste des unités d'enseignements

$queryUE = "select * from sgs_unité_enseignement";
$res = sqlsrv_query($conn,$queryUE);
?>

<p><strong> AJOUT ou MODIFCATION DE MATIERES </strong></p>

  <table width="349" border="1">
<form id="form1" name="form1" method="post" action="traitement.php">
  <tr>
    <td>Libellé UE </td>
    <td>
      <input type="text" name="libelle" />
    </tnoted>
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
			echo "<option value='".$ligne["code"]."'>".$ligne["libellé"]."</option>";			
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
//tester si le formulaire est envoyé avant d'effectuer des traitements
if (isset($_POST["codeUE"]))
{
	echo $_POST["codeUE"];

}


?>



</form>

	
</body>
</html>