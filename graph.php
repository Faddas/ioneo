<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="materialize/css/materialize.css"  media="all"/>>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
	<title>Premier widget</title>
</head>
<body style="background: #000000;" >
	<div class="container">
		<div style="  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  -webkit-box-pack: center;
  -ms-flex-pack: center;
  justify-content: center;" >
			<div class="row">
				<div class="col s2 offset-s12">
						<img class="responsive-img"src="image/Logo OR.PNG">
				</div>
				<div class="col s4 m3 l4 offset-m8">
				<p style="color:#0000ff;">Counter-Strike</p>
			</div>
			<div class="col s4 m3 l4 offset-m11">
				<p style="color:#0000ff ;">Data Analysis</p>
			</div>
					<div class="col s4">
					<div class="left">
					<div style="border-radius:20px" class="card-panel">
						<div style="text-align:center" class='card-content'>
							<form action="graph.php" method="POST" ><br>
								Recherche joueurs :<br>
								<input type="text" name="nom" placeholder="nom" id="nom"/>
								<?php var_dump($_POST['nom']); ?>
								<input type="submit" class=" waves-effect waves-light btn" value="valider" name="valider">
										<?php var_dump($_POST['nom']); ?>
									</form><p>
							</div>
						</div>
				</div>
			</div>
			<div class="right">
			<div class="row">
				<div class="col s12">
						<div  style="border-radius:20px "  class="card-panel">
								<canvas id="myChart"></canvas>
						</div>
					</div>
				</div>
			</div>
				<?php
				include('bdd.php');
				$doughnut = 100;
				$pseudo = $_POST['nom'];
				$reponse = $bdd->query("SELECT* FROM annuel INNER JOIN joueurs ON annuel.ID=joueurs.ID WHERE joueurs.pseudo ='" . $pseudo. "'");
				while($row =$reponse->fetch() ){
					$Kill_Deaths	= $row['Kills_Deaths'];
					$Damage_Rounds	= $row['Damage_Rounds'];
					$Bonus = $row['Bonus'];
					$kill_rounds = $row['Kills_round'];
					$moyenne= $row['Moyenne'];
					$indice = $row['Indice'];
					?>
	<!-- jQuery cdn -->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="crossorigin="anonymous"></script>
	<!-- Chart.js cdn -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js"></script>
	<script>

		Chart.pluginService.register({
	     beforeDraw: function (chart) {
	       if (chart.config.options.elements.center) {
	         //Get ctx from string
	         var ctx = chart.chart.ctx;

	         //Get options from the center object in options
	         var centerConfig = chart.config.options.elements.center;
	         var fontStyle = centerConfig.fontStyle || 'Arial';
	         var txt = centerConfig.text;
	         var color = centerConfig.color || '#000';
	         var sidePadding = centerConfig.sidePadding || 20;
	         var sidePaddingCalculated = (sidePadding/100) * (chart.innerRadius * 2)
	         //Start with a base font of 30px
	         ctx.font = "30px " + fontStyle;

	         //Get the width of the string and also the width of the element minus 10 to give it 5px side padding
	         var stringWidth = ctx.measureText(txt).width;
	         var elementWidth = (chart.innerRadius * 2) - sidePaddingCalculated;

	         // Find out how much the font can grow in width.
	         var widthRatio = elementWidth / stringWidth;
	         var newFontSize = Math.floor(30 * widthRatio);
	         var elementHeight = (chart.innerRadius * 2);

	         // Pick a new font size so it will not be larger than the height of label.
	         var fontSizeToUse = Math.min(newFontSize, elementHeight);

	         //Set font settings to draw it correctly.
	         ctx.textAlign = 'center';
	         ctx.textBaseline = 'middle';
	         var centerX = ((chart.chartArea.left + chart.chartArea.right) / 2);
	         var centerY = ((chart.chartArea.top + chart.chartArea.bottom) / 2);
	         ctx.font = fontSizeToUse+"px " + fontStyle;
	         ctx.fillStyle = color;

	         //Draw text in center
	         ctx.fillText(txt, centerX, centerY);
	       }
	     }
	   });

	   		var config = {
	   			type: 'doughnut',
	   			data: {
	   				datasets: [{
						backgroundColor: ["#3e95cd", "white"],
						data:[<?php echo $indice ?>,<?php echo $doughnut-$indice ?>]
	   				}]
	   			},
	   		options: {
	   			elements: {
	   				center: {
	   					text: <?php echo $indice ?>,
	             color: '#FF6384', // Default is #000000
	             fontStyle: 'Arial', // Default is Arial
	             sidePadding: 40 // Defualt is 20 (as a percentage)
	   				}
	   			}
	   		}
	   	};
	   		var ctx = document.getElementById("myChart").getContext("2d");
	   		var myChart = new Chart(ctx, config);

</script>
<div class="right">
<div class="row">
	<div class="col s12">
		<div class="card-panel" style="border-radius: 20px;">
			<canvas id="Chart_1"></canvas>
		</div>
	</div>
</div>
</div>
<script>
	var marksCanvas = document.getElementById("Chart_1");

	var marksData = {
		labels: ["KR","KD",'ADR','BON','IND',"MOY"],
		datasets: [{
			label: "",
			backgroundColor: "rgba(132,182,245,0.2)",
			borderColor:  ["#3e95cd"],
			data: [<?php echo $kill_rounds?>,<?php echo $Kill_Deaths?>,<?php echo $Damage_Rounds?>,<?php echo $Bonus ?>,<?php echo $indice ?>,<?php echo $moyenne ?>]
		}]
	};

	var chartOptions = {
		scale: {
			gridLines: {
				color: "#DCDCDC",
				lineWidth: 1
			},
			lineArc: true,
			angleLines: {
				display:true,
			},
			lineArc:{
				display:true,
			},
			ticks: {
				beginAtZero: true,
				min: 0,
				max: 100,
				stepSize: 50
			},
			pointLabels: {
				fontSize: 10,
				fontColor: "#DCDCDC"
			}
		},
		legend: {
			display:false,
			position: 'left'
		}
	};

	var radarChart = new Chart(marksCanvas, {
		type: 'radar',
		data: marksData,
		options: chartOptions,
	});
	</script>
<?php }?>
<?php
$reponse = $bdd->query("SELECT* FROM annuel INNER JOIN joueurs ON annuel.ID=joueurs.ID WHERE joueurs.pseudo ='" . $pseudo. "'");
while($row =$reponse->fetch() ){
	$pseudo	= $row['pseudo'];
	$nom	= $row['nom'];
	$prenom = $row['prenom'];
	$age = $row['age'];
	$pays = $row['pays'];
	$team = $row['team'];
}?>
	<div class="left">
<div class="row">
		<div class="col s12">
			<div class="card-panel" style="border-radius: 20px">
				<div class='card-content'>
					Pseudo: <?php echo $prenom ?> <b><?php echo$pseudo ?> </b><?php echo $nom  ?> <br>
					Team: <?php echo $team ?><br></br>
					Age: <?php echo $age ?> ans<br></br>
					Nationalite: <?php echo $pays ?><br></br>
					Poste: ???<br></br>
					Fin de contrat: ???
				</div>
			</div>
		</div>
	</div>
</div>
<?php
$reponse = $bdd->query("SELECT* FROM annuel INNER JOIN joueurs ON annuel.ID=joueurs.ID WHERE joueurs.pseudo ='" . $pseudo. "'");
while($row =$reponse->fetch() ){
	$Kill_Deaths	= $row['Kills_Deaths'];
	$Damage_Rounds	= $row['Damage_Rounds'];
	$Bonus = $row['Bonus'];
	$kill_rounds = $row['Kills_round'];
	$moyenne= $row['Moyenne'];
	$indice = $row['Indice'];
}?>
<div class=left>
<div class="row">
		<div class="col s12">
			<div class="card-panel" style=";border-radius: 20px">
				<div class='card-content'>
					KR:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $kill_rounds ?>/100 <br></br>
					KD: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $Kill_Deaths ?>/100<br></br>
				IND:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $indice ?>/100<br></br>
					MO: &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $moyenne ?>/100<br></br>
					DAM:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<?php echo $Damage_Rounds ?>/100<br></br>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
<script type="text/javascript">
$(function() {
	$("#nom").autocomplete({
		source : 'C_search_firstname.php',
		minLength:2,

	});
});
</script>
</div>
</div>
</body>
</html>
