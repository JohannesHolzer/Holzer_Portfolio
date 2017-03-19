<?php
	session_start();
	$_SESSION['search']=$_POST["search"];	//Suchvariable wird aus dem Formular in die Session geschrieben
	echo '<meta http-equiv="refresh" content="0; URL=data.php">';	//Seite wird refresht
?>