<?php
	session_start();
	$wantedkat=$_SESSION['kat'];
	$ID=$_POST['ID'];
	$dbc=mysqli_connect("localhost","root","","troubleticket") or die("MySQL nicht verfuegbar");	//Verbindung zur Datenbank aufbauen
	mysqli_select_db($dbc,"troubleticket") or die("Verbindung zur Datenbank fehlgeschlagen");
	$result=mysqli_query($dbc,"SELECT kat from ticket WHERE ticketID=$ID");
	$iskat=mysqli_fetch_assoc($result);
	if($iskat==$wantedkat)
	{
		mysqli_query($dbc,"UPDATE ticket SET status='erledigt' WHERE ticketID=$ID ");				//der Auftrag mit der gewählten ID wird als erledigt vermerkt, wenn er die Kategorie hat, der der Bearbeiter zugewiesen ist
	}
	else if($wantedkat==99)
	{
		mysqli_query($dbc,"UPDATE ticket SET status='erledigt' WHERE ticketID=$ID ");	//der Admin kann alle Tickets als erledigt markieren
	}
	else
	{	
		$message = "Sie haben keine Rechte, dieses Ticket zu bearbeiten.";	//Wenn versucht wird, ein Ticket aus einer anderen Kategorie zu bearbeiten
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
	echo '<meta http-equiv="refresh" content="0; URL=data.php">';	//Seite wird refresht
?>