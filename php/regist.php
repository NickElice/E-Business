<?php

use LDAP\Result;

if(isset($_GET["email"]) && isset($_GET["passwort"]) && isset($_GET["username"]) ){
$mysqli = new mysqli("localhost", "root", "", "ebissi");

if ($mysqli->connect_errno) {
	die("Verbindung fehlgeschlagen: " . $mysqli->connect_error);
}

$sql = "Insert Into ebusiness.benutzer(Email,Username,Password) values (?,?,?)";
$statement = $mysqli->prepare($sql);
$statement->bind_param('sss', $email, $username, $password);

$email = $_GET["email"];

$password=$_GET["passwort"];

$username=$_GET["username"];
$statement->execute();
print("schau in DB");
}
print("nix da");
?>
