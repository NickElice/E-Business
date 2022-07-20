
<?php

if (isset($_GET['email']) && isset($_GET['passwort']) ) {

$email= $_GET['email'];
$pass= $_GET['passwort'];

$mysqli = new mysqli("141.79.25.220", "lschmid5", "abc123", "BIS_POS_lschmid5");
if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SELECT * FROM BIS_POS_lschmid5.user where BIS_POS_lschmid5.user.email = ? and BIS_POS_lschmid5.user.Passwort = ? ";
$statement = $mysqli->prepare($sql);
$statement->bind_param("ss",$email, $pass);
$statement->execute();

$result = $statement->get_result();
$anzahltreffer = $result->num_rows;

if($anzahltreffer == 1){
	session_start();
	$rowUser = $result->fetch_assoc();

	$_SESSION["username"]= $rowUser["User_name"];
	header("location: index.php");
}
	else{
		header("location:login.html");
	}

}
?>