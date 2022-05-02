<?php

print("<h1>Willkommen, ");
session_start();
if (!isset($_SESSION['username'])) {
	header("location: login.html");
	exit();
}
$user = $_SESSION['username'];
print("$user</h1>");

?>

<form action="logout.php">
  <input type="submit" value="Logout">
</form>