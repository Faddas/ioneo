<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>ioneo</title>
	<!-- inclusion du style CSS de base -->
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="materialize/css/materialize.css"  media="all"/>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col s12 m8">
				<div class="card-panel" style="margin-left:45%">
					<div class='card-content'>
						<form method="POST" action=""><br>
							Recherche joueurs :<br>
							<input type="text" name="nom" placeholder="nom" id="nom"/>
						</form><p>
							<a class="btn z-depth-2" href="graph.php">Valider</a>
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
	</body>
	</html>
