<?php
echo '<br/>';
if(isset($_POST["joueurs"])){
	var_dump($_POST);
  header('location: graph.php');
}

 ?>
