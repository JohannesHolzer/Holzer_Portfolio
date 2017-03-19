-- Troubleticket

DROP TABLE auftraggeber;
DROP TABLE bearbeiter;
DROP TABLE ticket;
DROP TABLE kat; 
  
CREATE TABLE kat(
   katID int(11) NOT NULL
   ,kat VARCHAR(20)
   ,bez VARCHAR(40) 		   
   ,PRIMARY KEY (katID)
   );

CREATE TABLE ticket(
   ticketID int(11) NOT NULL AUTO_INCREMENT
   ,bez VARCHAR(600) 		
   ,prio int(11)
   ,status VARCHAR(20)
   ,datum timestamp
   ,kat int(11)   
   ,PRIMARY KEY (ticketID)
   ,FOREIGN KEY (kat) references kat(katID)
   );

CREATE TABLE bearbeiter(
   bearbeiterID int(11) NOT NULL AUTO_INCREMENT
   ,name VARCHAR(60)
   ,kontakt VARCHAR(35) 		
   ,ticket int(11)  
   ,PRIMARY KEY (bearbeiterID)
   ,FOREIGN KEY (ticket) references ticket(ticketID)
   );

CREATE TABLE auftraggeber(
   auftraggeberID int(11) NOT NULL AUTO_INCREMENT
   ,vorname VARCHAR(20)
   ,nachname VARCHAR(20) 		
   ,ticket int(11)  
   ,PRIMARY KEY (auftraggeberID)
   ,FOREIGN KEY (ticket) references ticket(ticketID)
   );

insert into bearbeiter (name, kontakt) values ('Franz Kafka','06509456386');
insert into bearbeiter (name, kontakt) values ('Rudolf Ditzen','06765584133');
insert into bearbeiter (name, kontakt) values ('Mara Richter','06762851268');

insert into kat values (0,'Software','Probleme mit Applikationen an Computern');
insert into kat values (1,'Hardware','Probleme mit Druckern, Computern');
insert into kat values (2,'Sozial','Psychologische Probleme');

--Testdaten
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Meine Keil-Software spinnt', 1,'offen', 0);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Heino', 'Ferguson', 1);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Die Matlab-Version auf der Schulwebsite ist veraltet!', 1,'offen', 0);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Khalilah', 'Admiraal', 2);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Ein Computer im EDV-Saal 4 ist abgestürzt und lässt sich nicht mehr hochfahren', 1,'offen', 1);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Lise', 'Lichtenberg', 3);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Das hintere Licht im Klassenraum der 2AHET ist ausgefallen', 1,'offen', 1);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Budi', 'Lundgren', 4);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Ich werde von meinen Mitschüler gemobbt', 1,'offen', 2);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Dietmar', 'Haupt', 5);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Die Buben in meiner Klasse starren mich die ganze Zeit an', 1,'offen', 2);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Ingrid', 'Schmidt', 6);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Ich bräuchte Hilfe beim Aufsetzen des Programms für das Bode 100 Messgerät', 1,'offen', 0);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Izolda', 'Danchev', 7);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Ein Multimeter im E-Labor mit der Inventarnummer 0273 funktioniert nicht', 1,'offen', 1);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Saffira', 'Traviss', 8);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Altium Designer abgelaufene Lizenz.', 1,'offen', 0);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Apollo', 'Thorburn', 9);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('for(;;) { reload_my_gun(); }', 1,'offen', 2);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Tilo', 'Abraham', 10);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('for(;;) { reload_my_gun(); }', 1,'offen', 2);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Tilo', 'Abraham', 11);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Ich knall euch alle ab! - ist ein gutes Buch, das ich gerne als Klassenlektüre vorschlagen würde.', 1,'offen', 2);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Benjamin', 'Schmid', 12);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Mein Word stürzt immer ab!', 1,'offen', 0);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Zejun', 'Lin', 13);
INSERT INTO ticket (bez, prio, status, kat) VALUES ('Diese Webseite ist gar nicht mal so schlecht', 1,'offen', 0);
INSERT INTO auftraggeber (vorname, nachname, ticket) VALUES ('Friedemann', 'Fabel', 14);