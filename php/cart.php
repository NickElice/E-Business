<?php
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
</head>");

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
		if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 10)) {
			// last request was more than 30 minutes ago
			session_unset();     // unset $_SESSION variable for the run-time 
			session_destroy();   // destroy session data in storage
		}
		$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
	}else {
	print("<a class='nav-link' href='../html/login.html'>"); print("Anmelden");
	 
	}
	 print("</a>
	</li>

  </ul>
</div>
</nav>
");




print("
<body>
<div class='col-md-8 cart'>
                    <div class='title'>
                        <div class='row'>
                            <div class='col'><h4><b>Shopping Cart</b></h4></div>
                            <div class='col align-self-center text-right text-muted'>3 items</div>
                        </div>
                    </div>    
                    <div class='row border-top border-bottom'>
                        <div class='row main align-items-center'>
                            <div class='col-2'><img class='img-fluid' src='https://i.imgur.com/1GrakTl.jpg'></div>
                            <div class='col'>
                                <div class='row text-muted'>Shirt</div>
                                <div class='row'>Cotton T-shirt</div>
                            </div>
                            <div class='col'>
                                <a href='#'>-</a><a href='#' class='border'>1</a><a href='#'>+</a>
                            </div>
                            <div class='col'>€ 44.00 <span class='close'>✕</span></div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='row main align-items-center'>
                            <div class='col-2'><img class='img-fluid' src='https://i.imgur.com/ba3tvGm.jpg'></div>
                            <div class='col'>
                                <div class='row text-muted'>Shirt</div>
                                <div class='row'>Cotton T-shirt</div>
                            </div>
                            <div class='col'>
                                <a href='#'>-</a><a href='#' class='border'>1</a><a href='#'>+</a>
                            </div>
                            <div class='col'>€ 44.00 <span class='close'>✕</span></div>
                        </div>
                    </div>
                    <div class='row border-top border-bottom'>
                        <div class='row main align-items-center'>
                            <div class='col-2'><img class='img-fluid' src='https://i.imgur.com/pHQ3xT3.jpg'></div>
                            <div class='col'>
                                <div class='row text-muted'>Shirt</div>
                                <div class='row'>Cotton T-shirt</div>
                            </div>
                            <div class='col'>
                                <a href='#'>-</a><a href='#' class='border'>1</a><a href='#'>+</a>
                            </div>
                            <div class='col'>€ 44.00 <span class='close'>✕</span></div>
                        </div>
                    </div>
                    <div class='back-to-shop'><a href='#'>←</a><span class='text-muted'>Back to shop</span></div>
                </div>
                </body>
                </html>

");
?>