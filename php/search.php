<?php

use LDAP\Result;
session_start();
//if (isset($_GET['benutzer']) && isset($_GET['passwort']) ) {
print("
	<!DOCTYPE html>
	<html>
	
	<head>
	  <meta charset='utf-8'>
	  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	  <title>Page Title</title>
	  <meta name='viewport' content='width=device-width, initial-scale=1'>
	  <link rel='stylesheet' href='../css/index.css'>
	  <!-- CSS only -->
	  <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'
		integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
	
	  <script src='https://kit.fontawesome.com/b05822756c.js' crossorigin='anonymous'></script>
	</head>
	");

$mysqli = new mysqli('localhost', 'root', '', 'aufgabe_ebusiness');
if ($mysqli->connect_errno) {
	die('Verbindung fehlgeschlagen: ' . $mysqli->connect_error);
}


//Kategorien für die Navbar
$sqlKategorie = 'SELECT * FROM aufgabe_ebusiness.kategorie';
$statementKategorie = $mysqli->prepare($sqlKategorie);
$statementKategorie->execute();
$resultKategorie = $statementKategorie->get_result();
/*
**********************************************************
!!!WICHTIG IMMER STATEMANTS FÜR STATEMANTS SONST FEHLER!!!
**********************************************************
*/

//Datenbank zugriff fuer Unterkategorie
$sqlUKategorie = 'SELECT * FROM aufgabe_ebusiness.u_kategorie WHERE  aufgabe_ebusiness.u_kategorie.FK_Kategorie =?';
$statementUKategorie = $mysqli->prepare($sqlUKategorie);
$statementUKategorie->bind_param("i",$id);
$id = 0;

//Datenbankabfrage: Kategorie Filter

if(isset($_GET["Kat"])){
	$Kat = $_GET["Kat"];

$sqlProdukt = 'SELECT aufgabe_ebusiness.produkt.* FROM aufgabe_ebusiness.produkt, aufgabe_ebusiness.u_kategorie WHERE aufgabe_ebusiness.u_kategorie.FK_Kategorie ='. $Kat .' AND aufgabe_ebusiness.u_kategorie.u_KateID = aufgabe_ebusiness.produkt.FK_u_kate';

}else if(isset($_GET["search"])){
$search = $_GET["search"];
$sqlProdukt = 'SELECT aufgabe_ebusiness.produkt.* FROM aufgabe_ebusiness.produkt WHERE aufgabe_ebusiness.produkt.Produkt_Name LIKE "'.  $search.'%"';

}else if(isset($_GET["ukat"])){
	$uKat = $_GET["ukat"];
	$sqlProdukt = "SELECT aufgabe_ebusiness.produkt.* FROM aufgabe_ebusiness.produkt, aufgabe_ebusiness.u_kategorie WHERE aufgabe_ebusiness.produkt.FK_u_kate =  $ukat";
}else



{
	$sqlProdukt = 'SELECT * FROM aufgabe_ebusiness.produkt';
}

$statementProdukt = $mysqli->prepare($sqlProdukt);
$statementProdukt->execute();
$resultProdukt = $statementProdukt->get_result();


//Search SQL Statement



//Eroeffnung statischer Tags
print("<body>");
print(" 
<nav class='navbar navbar-expand-sm bg-dark navbar-dark'>
<div class='container-fluid'>
  <ul>
	<li class='nav-item mt-3'><a class='navbar-brand ' href='../html/index.html'>Mein Shop</a></li>
  </ul>
  <div class='container col-sm-8'>
	<div class='input-group col-sm-4'>  
	<form  class='form-control col-sm-0' action='../php/search.php' method='get'>
	  <input class='form-control col-sm-0' type='search' value='search' name='search' id='search-input'>

	  <input type='submit' value='Search' class='btn btn-outline-secondary border' >
		</form>
		

	  </span>
	</div>
  </div>
  <ul class='navbar-nav'>
	<li class='nav-item'>
	  <a class='nav-link ' href='./cart.html'>Warenkorb</a>
	</li>
	<li class='nav-item'>
	  <a class='nav-link' href='#'>Über uns</a>
	</li>
	<li class='nav-item'>
");?>
	<?php if(isset($_SESSION["username"]))
	  { print("<a class='nav-link' href='logout.php'>"); 
		print("Abmelden");
	}else {
	print("<a class='nav-link' href='../html/login.html'>"); print("Anmelden");
	 
	}
	 print("</a>
	</li>

  </ul>
</div>
</nav>
");

print("<nav class='navbar navbar-expand-sm navbar-costum navbar-dark'>
<div class='container'>");
while ($rowKategorie = $resultKategorie->fetch_assoc()) {

$statementUKategorie->bind_param("i",$nextId);
$nextId = $id+1;
$id = $nextId;
$statementUKategorie->execute();
$resultUKategorie = $statementUKategorie->get_result();
	
	print("
  <div class='dropdown'>
	");
?>

	<?php
	print("<h3 class='kategorie'><a class='kategorie_text' href='./index.php?Kat=$rowKategorie[KategorieID]'>"); print($rowKategorie['KategorieName']); print("</a></h3>");
	?>

	<?php 
	while($rowUKategorie = $resultUKategorie->fetch_assoc()){
print("<p class='unterkategorie'><a class='unterkategorie_text' href='./index.php?ukat=$rowUKategorie[u_KateID]'>"); print($rowUKategorie['u_Kate_Name']); print("</a></p>");

	}
	?>
	
	
	
	
	<?php
	print("</div>");
}
print("</div></nav>");
if(isset($_SESSION["username"])){
print("
<div class='container mt-4 px-lg-3'>
    <h3>Hallo,");
	$user = $_SESSION["username"];

	print(" $user</h3>
</div>

");
}
print("<section class='py-3'>
<div class='container  mt-5 px-lg-5'>
<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>");


//Erstelle so viele Cards wie Produkte es gibt 
while ($rowProdukt = $resultProdukt->fetch_assoc()) {
	print("<div class='col mb-5'>
	<div class='card h-120'><img class='card-img-top' src='"); 
	
	print($rowProdukt["Bild_Path"]);
	
	print("
		'alt='Bild von Produkt'>
	  <div class='card-body p-4'>
		<div class='text-center'>
		  <h5 class='fw-bolder'>") ?> <?php print($rowProdukt['Produkt_Name']) ?><?php print("</h5>") ?> <?php print($rowProdukt['Preis']) ?> <?php print("€
		</div>
	  </div>
	  <div class='card-footer p-4 border-top-0 pt-0 bg-transparent'>
		<div class='text-center'><a class='btn btn-outline-dark mt-auto' href='#'>Zu Warenkorb hinzufügen</a>
		</div>
	  </div>
	</div>
  </div>
	");
}

//Schliesende Tags fuer statischen teil des body
print("
			</div>
			</div>
			</section>
");
	session_destroy();																																print("</Body>");
																																			print("</html>");
?>