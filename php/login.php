
<?php


$mysqli = new mysqli("localhost", "root", "", "mydb");
if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}
$sql = "SELECT * FROM mydb.produkt";
$statement = $mysqli->prepare($sql);
$statement->execute();

$result = $statement->get_result();

while ($row = $result->fetch_assoc()) {
	print $row["produktName"];
	print "<br>";
}

?>