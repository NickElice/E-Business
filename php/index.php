<?php

use LDAP\Result;

//if (isset($_GET["benutzer"]) && isset($_GET["passwort"]) ) {
$user = $_GET["benutzer"];
$pass = $_GET["passwort"];

$mysqli = new mysqli("localhost", "root", "", "mydb");
if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SELECT * FROM mydb.produkt WHERE produkt.produktName = 'Segelboot' ";
$statement = $mysqli->prepare($sql);
$statement->execute();

$result = $statement->get_result();

while ($row = $result->fetch_assoc()) {
	echo $row["produkt.produktName"];
	
}

	
	
//	if ($count == 1) {
//		session_start();
//		$_SESSION['username']=$user;
//		header("location: home.php");
//	} else {
//		header("location: login.html");
//	}

//}
