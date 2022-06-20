
<?php

if (isset($_GET['email']) && isset($_GET['passwort']) ) {

$email= $_GET['email'];
$pass= $_GET['passwort'];

$mysqli = new mysqli("localhost", "root", "", "aufgabe_ebusiness");
if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SELECT * FROM aufgabe_ebusiness.user where aufgabe_ebusiness.user.email = ? and aufgabe_ebusiness.user.Passwort = ? ";
$statement = $mysqli->prepare($sql);
$statement->bind_param("ss",$email, $pass);
$statement->execute();

$result = $statement->get_result();
$anzahltreffer = $result->num_rows;

if($anzahltreffer == 1){
	session_start();
	$_SESSION["username"]=$user;
	header("location: index.php");
}
	else{
		header("location:login.html");
	}

}
?>