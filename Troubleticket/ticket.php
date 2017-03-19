<?php
	$vn=$_POST["vorname"];	//Variablen kürzere Namen geben
	$nn=$_POST["nachname"];
	$kat=$_POST["subject"];
	$bez=$_POST["bez"];
	$dbc=mysqli_connect("localhost","root","","troubleticket") or die("MySQL nicht verfuegbar");	//Verbindung zur Datenbank aufbauen
	mysqli_select_db($dbc,"troubleticket") or die("Verbindung zur Datenbank fehlgeschlagen");		//Datenbank auswählen
	$einlesen = mysqli_query($dbc,"SELECT prio FROM ticket WHERE bez='$bez'");	//Falls es die Bezeichnung schon einmal gibt, soll die Priorität davon
	$prio1=mysqli_num_rows($einlesen);											//hochgezählt werden
	if(empty($prio1))	//Wenn es keinen Datensatz mit derselben Bezeichnung gibt
	{
		if(!empty($vn) && !empty($nn) && !empty($bez))	//wenn alle Felder des Formulars ausgefüllt sind, wird es entsprechend in die Datenbank eingetragen
		{
			mysqli_query ($dbc,"INSERT INTO ticket (bez, status, prio, kat) VALUES ('$bez', 'offen', 1, $kat)");
			$letzteID=mysqli_insert_id($dbc);
			mysqli_query ($dbc,"INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('$vn', '$nn', $letzteID)");
			$error=0;	//Zum Auswählen der Nachricht, die als pop-up angezeigt wird
		}
		else 
		{
			$error=1;	//Zum Auswählen der Nachricht, die als pop-up angezeigt wird
		}
	}
	else 	//sollte es diese Bezeichnung schon geben, wird die Priorität hochgezählt
	{
		$row= mysqli_fetch_array($einlesen);	//damit die Priorität als integer hochgezählt werden kann
		$prio = $row['prio'];
		$prio=$prio+1;
		mysqli_query ($dbc,"UPDATE ticket SET prio=$prio where bez='$bez'");
		$error=0;	//Zum Auswählen der Nachricht, die als pop-up angezeigt wird
	}
	if($error!=0)	//Wenn etwas falsch gelaufen ist
	{
		echo '<meta http-equiv="refresh" content="0; URL=ticket.html">';
	
		$message = "Abgabe fehlgeschlagen. Überprüfen sie, ob sie alle Felder ausgefüllt haben.";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
	else	//Wenn das Ticket erfolgreich abgegeben wurde
	{
		echo '<meta http-equiv="refresh" content="0; URL=ticket.html">';
		
		$message = "Eintrag erfolgreich";
		echo "<script type='text/javascript'>alert('$message');</script>";
	}
	mysqli_close($dbc);
?>