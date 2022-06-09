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

$mysqli = new mysqli('localhost', 'root', '', 'ebusiness');
if ($mysqli->connect_errno) {
	die('Verbindung fehlgeschlagen: ' . $mysqli->connect_error);
}
$sql = 'SELECT * FROM ebusiness.produkt';
$statement = $mysqli->prepare($sql);
$statement->execute();

$result = $statement->get_result();

//Eroeffnung statischer Tags
print("<body>");
print("<section class='py-5'>
<div class='container  mt-5 px-lg-5'>
<div class='row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center'>");


//Erstelle so viele Cards wie Produkte es gibt 
while ($row = $result->fetch_assoc()) {
	print("<div class='col mb-5'>
	<div class='card h-120'><img class='card-img-top' src='https://dummyimage.com/450x300/dee2e6/6c757d.jpg'
		alt='Bild von Produkt'>
	  <div class='card-body p-4'>
		<div class='text-center'>
		  <h5 class='fw-bolder'>Item 1</h5>7€
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