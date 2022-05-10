
<?php

use LDAP\Result;
if(isset($_GET["benutzer"]) && isset($_GET["passwort"]) ){
$mysqli = new mysqli("localhost", "root", "", "mydb");
if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SELECT * FROM mydb.user where user.email = ? and password = ?";
$statement = $mysqli->prepare($sql);
$statement->execute();

$result = $statement->get_result();

while ($row = $result->fetch_assoc()) {
	print $row["produktName"];
	print "<br>";
}
}
?>