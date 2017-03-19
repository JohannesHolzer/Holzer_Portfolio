<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
      <!-- HEAD SECTION-->
<head>
    <meta charset="utf-8">
    <title>Troubleticket GmbH</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
     <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!-- MAIN STYLE SECTION-->
    <link href="assets/plugins/isotope/isotope.css" rel="stylesheet" media="screen" />
    <link href="assets/plugins/fancybox/jquery.fancybox.css" rel="stylesheet" />
    <link href="assets/plugins/IconHoverEffects-master/css/component.css" rel="stylesheet" />
    <link href="assets/plugins/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/about-achivements.css" rel="stylesheet" />
    <link id="mainStyle" href="assets/css/style-green.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
    <!-- END MAIN STYLE SECTION-->
</head>
<!-- END HEAD SECTION-->

     <!-- BODY SECTION-->
<body>

     <!-- HEADER SECTION-->
    <div class="navbar navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="fa fa-bars mobile-bars" style=""></span>
                </button>
                <a class="navbar-brand" href="https://www.htl-hl.ac.at" >
                    <img src="assets/img/htL_logo.gif" alt="" title="Hiermit gelangen sie zurück zur Webseite der HTL Hollabrunn"/> <!-- logo here-->
                </a>
            </div>
            <div class="navbar-collapse collapse" data-scrollreveal="enter from the right 50px">
                <ul class="nav navbar-nav">
                    <li class=""><a href="index.html">Home</a></li><!-- menu links-->
                    <li><a href="ticket.html">Ticket aufgeben</a></li>  
                    <li><a href="logout.php">Abmeldung</a></li>
                </ul>
            </div>

        </div>
    </div>
     <!-- END HEADER SECTION-->

    <!--PAGE CONTENT--> 
    <!-- HOMEPAGE SECTION-->  
	
<!--		<div class="col-md-8">-->
                    <div  id="data1" >
						<?php
							//Seite zum Darstellen der Daten
							session_start();	//Session für Login und Search-Variable
							if(!isset($_SESSION['ID']))	//Wenn man sich nicht angemeldet hat, wird man zurück zur Hauptseite geleitet
							{
								echo '<meta http-equiv="refresh" content="0; URL=index.html">';		//Weiterleitung zu index.html
								$message = "Sie müssen sich anmelden, um auf diese Seite Zugriff zu haben!";	//Nachricht wird am Bildschirm als pop-up 
								echo "<script type='text/javascript'>alert('$message');</script>";				//angezeigt
							}
							$ID=$_SESSION['ID'];
							$dbc=mysqli_connect("localhost","root","") or die("MySQL nicht verfuegbar");	//Verbindung zur Datenbank aufbauen
							mysqli_select_db($dbc,"troubleticket") or die("Verbindung zur Datenbank fehlgeschlagen");		//Datenbank auswählen
							if($ID==1){$wantedkat=0;}											//es wird überprüft, mit welcher ID eingeloggt wurde
							else if($ID==2){$wantedkat=1;}
							else if($ID==3){$wantedkat=2;}
							else if($ID=='admin'){$wantedkat=99;}
							$_SESSION['kat']=$wantedkat;
							if(isset($_SESSION['search'])){ $search=$_SESSION['search'];}
							echo '<form action="suchen.php" method="POST" autocomplete="off" style="margin-left:60%; float:left;">	
									<input type="search" placeholder="Suchen..." name="search" style="width:100px;">
									<input type="submit" style="height: 30px; margin-bottom: 10px; float:right;" class="col-md-5 btn btn-primary" value="Suchen">
								 </form>';	//Formular für Suchfeld
							echo '<form action="reset.php" method="POST" autocomplete="off" style="margin-right:7%;">
									<input type="submit" style="height: 30px; margin-bottom: 10px; float:right;" class="col-md-2 btn btn-primary" value="Suche resetten">
								 </form>';	//Formular fürs Resetten der Suche	
							if(isset($search))	//Wenn die Suchvariable nicht leer ist, wird das Gesuchte als Bedingung bei der MySQL-Abfrage berücksichtigt
							{
								if($wantedkat==99)	//wenn man als Admin angemeldet ist, wird bei allen Kategorien gesucht
								{
									$result = mysqli_query ($dbc," SELECT * FROM ticket JOIN auftraggeber ON ticketID=ticket WHERE bez like '%$search%'");
								}
								else	//bei anderen ID's nur bei der zugeordneten Kategorie
								{
									$result = mysqli_query ($dbc," SELECT * FROM ticket JOIN auftraggeber ON ticketID=ticket WHERE bez like '%$search%' having kat=$wantedkat and status='offen'");
								}	
							}
							else	//wenn die Suchvariable leer ist, ist bei der MySQL-Abfrage kein Zusatz dafür vorgesehen
							{
								if($wantedkat==99) //wenn man als Admin angemeldet ist, werden alle Kategorien angezeigt	
								{
									$result = mysqli_query ($dbc," SELECT * FROM ticket JOIN auftraggeber ON ticketID=ticket");
								}
								else //bei anderen ID's nur die zugeordnete Kategorie
								{
									$result = mysqli_query ($dbc," SELECT * FROM ticket JOIN auftraggeber ON ticketID=ticket WHERE kat=$wantedkat AND status='offen' ORDER BY prio DESC");
								}
							}
							echo '<table border="1" align="center">';	//Tabelle für die Daten erstellen
							echo '<tr>
									<td align="center">TicketID</td>
									<td align="center">Kategorie</td>
									<td>Bezeichnung</td>
									<td align="center">Status</td>
									<td align="center">Vorname</td>
									<td align="center">Nachname</td>
									<td align="center">Zeitstempel</td>
								  </tr>';
							while ( $row = mysqli_fetch_array ( $result )) 	//solange noch Datensätze vorhanden sind, wird die nächste Reihe eingelesen
							{
								echo '
									<tr>
										<td align="center">'.$row["ticketID"].'</td>
										<td align="center">'.$row['kat'].'</td>
										<td>'.$row["bez"].'</td>
										<td align="center">'.$row["status"].'</td>
										<td align="center">'.$row["vorname"].'</td>
										<td align="center">'.$row["nachname"].'</td>
										<td>'.$row['datum'].'</td>
									</tr>
								';
							}
							echo '</table>';
							echo '<form action="erledigt.php" method="POST" autocomplete="off" style="margin-left:60%; float:left">
									<input type="search" placeholder="ID" name="ID" style="width:100px;">
									<input type="submit" style="height: 30px; margin-bottom: 50px; margin-right: 5px;" class="col-md-5 btn btn-primary" value="Erledigt">
								 </form>';	//Wenn man ein Ticket als erledigt markieren will
							mysqli_close($dbc);	//Verbindung zur Datenbank auflösen
						?>
                    </div>
                <!--</div>-->
		</div>
    </section>
     <!--END HOMEPAGE SECTION-->

    <!-- MAIN SCRIPTS SECTION-->
    <script src="assets/js/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/scrollReveal.js"></script>
    <script>
        window.scrollReveal = new scrollReveal(); //please put this script here to show animation at the time of scroll
    </script>
    <script src="assets/js/jquery.easing.1.3.js"></script>
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/isotope/jquery.isotope.min.js"></script>
    <script src="assets/plugins/fancybox/jquery.fancybox.pack.js"></script>
    <script src="assets/js/jquery.localscroll-1.2.7-min.js"></script>
    <script src="assets/js/jquery.appear.js"></script>
    <script src="assets/scripts/main.js"></script>
   
     <!--END MAIN SCRIPTS SECTION-->
</body>

    <!--END  BODY SECTION-->
</html>