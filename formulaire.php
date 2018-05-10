<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Liste déroulante test</title>
</head>

<body>
<form name="form" method="post">

       <label for="joueurs">joueurs 1</label><br />
       <select name="joueurs" id="joueurs" >
<?php
try
{
        $bdd = new PDO('mysql:host=localhost;dbname=ioneo', 'root', '');
}
catch(Exception $e)
{
            die('Erreur : '.$e->getMessage());
}


$reponse = $bdd->query('SELECT * FROM joueurs');
while ($donnees = $reponse->fetch())
{
?>
             <option  value=" <?php echo $donnees['pseudo']; ?>"><?php echo $donnees["prenom"]." ".$donnees['pseudo']." ".$donnees["nom"]; ?></option>
<?php
}

$reponse->closeCursor();

?>
</select>
<br><br>
<form name="form" method="post" >

       <label for="joueurs">joueurs 2</label><br />
       <select name="joueurs2" id="joueurs2" onchange=" submitform();">
<?php
try
{
        $bdd = new PDO('mysql:host=localhost;dbname=ioneo', 'root', '');
}
catch(Exception $e)
{
            die('Erreur : '.$e->getMessage());
}
?>
<?php
$reponse = $bdd->query('SELECT * FROM joueurs');
while ($donnees = $reponse->fetch())
{
?>
           <option  value=" <?php echo $donnees['pseudo']; ?>"><?php echo $donnees["prenom"]." ".$donnees['pseudo']." ".$donnees["nom"];?></option>
<?php
}

$reponse->closeCursor();

?>
</select>
</form>
<?php
include("traitement.php");
 ?>
<script type="text/javascript">
function submitform()
{
  document.form.submit();
}
</script>
</body>
</html>
