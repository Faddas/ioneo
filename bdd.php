
<?php
$bdd = new PDO('mysql:host=projetjokfioneo.mysql.db;dbname=projetjokfioneo', 'projetjokfioneo', 'Faddas01' );
$bdd->exec("set names utf8");
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
