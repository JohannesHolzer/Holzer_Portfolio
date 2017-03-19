<?php
	session_start(); //beim Logout sollen die Variablen in der Session gelöscht werden
	unset($_SESSION['ID']);
	unset($_SESSION['search']);
	unset($_SESSION['kat']);
	session_destroy();
	echo '<meta http-equiv="refresh" content="0; URL=index.html">';	//danach wird man zur Hauptseite weitergeleitet
?>