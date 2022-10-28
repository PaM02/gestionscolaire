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
<title>Document sans nom</title>
</head>

<body>
<?php
include('parametres_connection.php');

$query="select * from sgs_unité_enseignement";

$res=sqlsrv_query($conn,$query);



?>


<table width="349" border="1">
<form id="form1" name="form1" method="post" action="traitement.php">
  <tr>
    <td>Libellé UE </td>
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






</body>
</html>
