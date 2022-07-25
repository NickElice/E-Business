
<?php

if (isset($_GET['email']) && isset($_GET['passwort']) ) {

$email= $_GET['email'];
$pass= $_GET['passwort'];

$mysqli = new mysqli("141.79.25.220", "nelice", "fruchttiger1", "BIS_DB_nelice");
if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SELECT * FROM BIS_DB_nelice.user where BIS_DB_nelice.user.email = ? and BIS_DB_nelice.user.Passwort = ? ";
$statement = $mysqli->prepare($sql);
$statement->bind_param("ss",$email, $pass);
$statement->execute();

$result = $statement->get_result();
$anzahltreffer = $result->num_rows;

if($anzahltreffer == 1){
	session_start();
	$rowUser = $result->fetch_assoc();

	$_SESSION["username"]= $rowUser["User_name"];
	$_SESSION["cartItem"] = array();
	$_SESSION["timeout"] = time();
	header("location: index.php");
}
	else{
		header("location:login.html");
	}

}
?>