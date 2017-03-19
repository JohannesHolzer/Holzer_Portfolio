<?php
	session_start();	//Wenn die Suche resettet wird, wird die Suchvariable gelöscht
	unset($_SESSION['search']);
	echo '<meta http-equiv="refresh" content="0; URL=data.php">';	//Seite wird refresht
?>