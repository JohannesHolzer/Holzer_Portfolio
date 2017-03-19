<?php
	session_start();	//Start der Session für ID
	$ID=$_SESSION['ID']=$_POST["ID"];
	$pwd=$_POST["pwd"];
	
	if(($ID=="1" && $pwd=="12345") || 
		($ID=="2" && $pwd=="54321") || 
		($ID=="3" && $pwd=="1234567890") || 
		($ID=="admin" && $pwd=="admin"))			//Wenn ein richtiger login eingegeben wurde, wird man zu data.php weitergeleitet
	{
		echo '<meta http-equiv="refresh" content="0; URL=data.php">';
	}
	else	//Wenn der Login nicht richtig ist, wird die Seite refresht
	{
		echo '<meta http-equiv="refresh" content="0; URL=login.html">';
		
		$message = "Login fehlgeschlagen! Überprüfen sie ihre Login-Daten.";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}

?>