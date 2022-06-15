<?php

use LDAP\Result;

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
$sqlProdukt = 'SELECT * FROM aufgabe_ebusiness.produkt';
$statementProdukt = $mysqli->prepare($sqlProdukt);
$statementProdukt->execute();
$resultProdukt = $statementProdukt->get_result();

//Kategorien für die Navbar
$sqlKategorie = 'SELECT * FROM aufgabe_ebusiness.kategorie';
$statementKategorie = $mysqli->prepare($sqlKategorie);
$statementKategorie->execute();
$resultKategorie = $statementKategorie->get_result();
/*

!!!WICHTIG IMMER STATEMANTS FÜR STATEMANTS SONST FEHLER!!!
*/
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
	  <input class='form-control col-sm-0' type='search' value='search' id='search-input'>
	  <span class='input-group-append'>
		<button class='btn btn-outline-secondary  border' type='button'>
		  <i class='fa fa-search'></i>
		</button>
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

	  <a class='nav-link' href='./login.html'>Anmelden</a>
	</li>

  </ul>
</div>
</nav>
");

print("<nav class='navbar navbar-expand-sm navbar-costum navbar-dark'>
<div class='container'>");
while($rowKategorie = $resultKategorie->fetch_assoc()){
print("
  <div class='dropdown'>
	<button type='button' class='btn dropdown-toggle text-white' data-bs-toggle='dropdown'>");
	?>

	<?php print($rowKategorie['KategorieName']) ?>
	<?php
	print("</button>
	<ul class='dropdown-menu'>
	  <li><a class='dropdown-item' href='#'>Link 1</a></li>
	  <li><a class='dropdown-item' href='#'>Link 2</a></li>
	  <li><a class='dropdown-item' href='#'>Link 3</a></li>
	</ul>
  </div>



");
}
print("</div>
</nav>");

print("<section class='py-5'>
<div class='container  mt-5 px-lg-5'>
<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>");


//Erstelle so viele Cards wie Produkte es gibt 
while ($rowProdukt = $resultProdukt->fetch_assoc()) {
	print("<div class='col mb-5'>
	<div class='card h-120'><img class='card-img-top' src='https://dummyimage.com/450x300/dee2e6/6c757d.jpg'
		alt='Bild von Produkt'>
	  <div class='card-body p-4'>
		<div class='text-center'>
		  <h5 class='fw-bolder'>")?> <?php print($rowProdukt['Produkt_Name']) ?><?php print("</h5>") ?> <?php print($rowProdukt['Preis']) ?> <?php print("€
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
print("</Body>");
		print("</html>");
//	if ($count == 1) {
//		session_start();
//		$_SESSION['username']=$user;
//		header('location: home.php');
//	} else {
//		header('location: login.html');
//	}

//}
?>