<?php

use LDAP\Result;

if(isset($_GET["email"]) && isset($_GET["passwort"]) && isset($_GET["username"]) ){
$mysqli = new mysqli("localhost", "root", "", "aufgabe_ebusiness");
$user = $_GET["username"];
$pass = $_GET["passwort"];
$email = $_GET["email"];
if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}

$sql = "INSERT INTO `aufgabe_ebusiness`.`user` (`User_name`,`Passwort`, `email`) VALUES (?, ?, ?)";
$statement = $mysqli->prepare($sql);
$statement->bind_param('sss',  $user, $pass, $email);


$statement->execute();
print("schau in DB");
header("location: ../html/login.html");
}
else{
print("nix da");
}
?>
