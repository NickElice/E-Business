<?php

use LDAP\Result;
session_start();
//if (isset($_GET['benutzer']) && isset($_GET['passwort']) ) {
	
	function isLoginSessionExpired() {
		$login_session_duration = 900; 
	//	$current_time = time(); 
		if(isset($_SESSION['timeout']) && isset($_SESSION['username'])){  
			if(((time() - $_SESSION['timeout']) > $login_session_duration)){ 
				
				$_SESSION['timeout'] = time();
				$_SESSION['timeoutBool'] = true;  // update creation time
				return true; 
			} 
		}
		$_SESSION['timeout'] = time();
		$_SESSION['timeoutBool'] = false;
		return false;
	}
	if(isset($_SESSION["username"])) {
		if(isLoginSessionExpired()) {
			header("Location: logout.php");
		}
	}
/*
	if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 10)) {
		// last request was more than 30 minutes ago
		echo "session expired: ".(time() - $_SESSION['LAST_ACTIVITY'])." sek.";
		$expired = true;
		session_unset();
		session_destroy();   // destroy session data in storage
		
	}else{
	$_SESSION['LAST_ACTIVITY'] = time();
	}
	$_SESSION["expired"]=$expired;
	*/
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

$mysqli = new mysqli('141.79.25.220', 'lschmid5', 'abc123', 'BIS_POS_lschmid5');
if ($mysqli->connect_errno) {
	die('Verbindung fehlgeschlagen: ' . $mysqli->connect_error);
}


//Kategorien für die Navbar
$sqlKategorie = 'SELECT * FROM .kategorie';
$statementKategorie = $mysqli->prepare($sqlKategorie);
$statementKategorie->execute();
$resultKategorie = $statementKategorie->get_result();
/*
**********************************************************
!!!WICHTIG IMMER STATEMANTS FÜR STATEMANTS SONST FEHLER!!!
**********************************************************
*/

//Datenbank zugriff fuer Unterkategorie
$sqlUKategorie = 'SELECT * FROM BIS_POS_lschmid5.u_kategorie WHERE  BIS_POS_lschmid5.u_kategorie.FK_Kategorie =?';
$statementUKategorie = $mysqli->prepare($sqlUKategorie);
$statementUKategorie->bind_param("i",$id);
$id = 0;

//Datenbankabfrage: Kategorie Filter

if(isset($_GET["Kat"])){
	$Kat = $_GET["Kat"];

$sqlProdukt = 'SELECT BIS_POS_lschmid5.produkt.* FROM BIS_POS_lschmid5.produkt, BIS_POS_lschmid5.u_kategorie WHERE BIS_POS_lschmid5.u_kategorie.FK_Kategorie ='. $Kat .' AND BIS_POS_lschmid5.u_kategorie.u_KateID = BIS_POS_lschmid5.produkt.FK_u_kate';

}else
 if(isset($_GET["ukat"])){
	$uKat = $_GET["ukat"];
	$sqlProdukt = "SELECT BIS_POS_lschmid5.produkt.* FROM BIS_POS_lschmid5.produkt, BIS_POS_lschmid5.u_kategorie WHERE BIS_POS_lschmid5.produkt.FK_u_kate =  $uKat  AND BIS_POS_lschmid5.produkt.FK_u_kate = BIS_POS_lschmid5.u_kategorie.u_KateID ";
}else{
	$sqlProdukt = 'SELECT * FROM BIS_POS_lschmid5.produkt';
}
$statementProdukt = $mysqli->prepare($sqlProdukt);
$statementProdukt->execute();
$resultProdukt = $statementProdukt->get_result();






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
	  <a class='nav-link ' href='./cart.php'>Warenkorb</a>
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
if(!isLoginSessionExpired()){
if(isset($_SESSION["username"])){
print("
<div class='container mt-4 px-lg-3'>
    <h3>Hallo,");
	$user = $_SESSION["username"];

	print(" $user</h3> 
</div>

");
}else{
	print("
	<div class='container mt-4 px-lg-3'>
		<h3>Bitte neu einloggen!</h3> 
	</div>
	
	");
}
}
print("<section class='py-3'>
<div class='container  mt-5 px-lg-5'>
<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>");


//Erstelle so viele Cards wie Produkte es gibt 
while ($rowProdukt = $resultProdukt->fetch_assoc()) {
	print("<form action='../php/addToCart.php ' method='get'>
	<div class='col mb-5'>
	<div class='card h-120'><img class='card-img-top' src='"); 
	
	print($rowProdukt["Bild_Path"]);
	
	print("
		'alt='Bild von Produkt'>
	  <div class='card-body p-4'>
		<div class='text-center'>
		  <h5 class='fw-bolder' name='produktname'>"); ?>
		  
		  <?php print($rowProdukt['Produkt_Name']); ?>
		  <?php print("</h5>"); ?> <?php print("<p name='preis'>");
		   print($rowProdukt['Preis']);
		 ?> 
			<?php print("€ </p>
		</div>
	  </div>
	  <div class='card-footer p-4 border-top-0 pt-0 bg-transparent'>
		 <div class='text-center'><button type='submit' name='cartItem' value='$rowProdukt[Produkt_Name]'>Zu warenkorb hinzufügen</button>
		</div>
	  </div>
	</div>
  </div>
  </form>
	");
}

//Schliesende Tags fuer statischen teil des body
print("
			</div>
			</div>
			</section>
");

			print("<form action='../php/testCart.php ' method='get'><button type='submit' name='cartItem' value='$rowProdukt[Produkt_Name]'>Zu warenkorb hinzufügen</button></form>");																					
			print("</Body>");
			print("</html>");





?>