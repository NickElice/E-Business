
<?php


$mysqli = new mysqli("localhost", "root", "", "ebusiness");
if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SELECT * FROM ebusiness.benutzer ";
$statement = $mysqli->prepare($sql);
$statement->execute();

$result = $statement->get_result();

while ($row = $result->fetch_assoc()) {
	print $row["benutzername"];
	print "<br>";
}

?>