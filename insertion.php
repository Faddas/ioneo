<!DOCTYPE  html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
	<form name="form" method="post">
		<p>Pseudo :<input type="text" name="pseudo"/></p>
		<p>Nom :<input type="text" name="nom">
		<p>Prenom:<input type="text" name="prenom">
		<p>age:<input type="text" name="age">
		<p>pays:<input type="text" name="pays">
		<p>team:<input type	="text" name="team">
		<input type="submit" name="valider" value="Valider">
	</form>
	<form name="form" method="post">
		<p>Kills / round :<input type="text" name="kill"/></p>
		<p>Kill / Deaths :<input type="text" name="ratio">
		<p>Deaths / round:<input type="text" name="death">
		<p>Damage / Round:<input type="text" name="damage">
		<p>Bonus:<input type="text" name="bonus">
		<p>Malus:<input type="text" name="malus">
		<input type="submit" name="sub" value="Valider">
	</form>
	<h3>Resultats apres calcul BDD :</h3>
	<?php
  include_once('bdd.php');
  
		if (isset ($_POST['valider'])){
			$nom=$_POST['nom'];
			$prenom=$_POST['prenom'];
			$pseudo=$_POST['pseudo'];
			$age=$_POST['age'];
			$pays=$_POST['pays'];
			$team=$_POST['team'];
			$reponse=$bdd->prepare("INSERT INTO joueurs (pseudo, nom, prenom, age, pays, team) VALUES(?, ?, ?, ?, ?,?)");
			$reponse->execute(array($pseudo,$nom,$prenom,$age,$pays,$team));
		}

	if(isset($_POST['sub'])){
		$kill=$_POST['kill'];
		$kill_deaths = $_POST['ratio'] ;
		$death=$_POST['death'];
		$damage=$_POST['damage'];
		$bonus=$_POST['bonus'];
		$malus=$_POST['malus'];
		$kill_rounds = $_POST['kill'] * 100/1.5;
		$kill_deaths = $_POST['ratio'] * 100/1.5;
		$damage_rounds = $_POST['damage'] /1.5;
		$moyenne = ($kill_deaths+$kill_rounds+$damage_rounds)/3;
		$total = $_POST['bonus'] + $moyenne;
	    echo('kill/rounds=');
		echo round($kill_rounds,2);
		echo'<br/>';
		echo('KDA=');
		echo round($kill_deaths,2);
		echo'<br/>';
		echo('Damage/rounds=');
		echo round($damage_rounds,2);
		echo'<br/>';
		echo('Moyenne=');
		echo round($moyenne,2);
		echo'<br/>';
		echo('Moyenne Global=');
		echo round($total,2);
		$rep=$bdd->prepare("INSERT INTO stats (Kills_round,Kills_Deaths, Deaths_Rounds, Damage_Rounds, Bonus, Malus, Moyenne, Moyenne_Total) VALUES(?, ?, ?, ?, ?, ?, ?,?)");
		$rep->execute(array($kill_rounds,$kill_deaths, $death, $damage_rounds,$bonus,$malus, $moyenne, $total));
	}
		?>
</body>
</html>
