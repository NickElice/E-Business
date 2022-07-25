<?php
session_start();

/*$mysqli = new mysqli('141.79.25.220', 'lschmid5', 'abc123', 'BIS_POS_lschmid5');
if ($mysqli->connect_errno) {
	die('Verbindung fehlgeschlagen: ' . $mysqli->connect_error);
}*/

if(isset($_SESSION["username"])&& $_SESSION["timeoutBool"]==false){
   array_push($_SESSION["cartItem"],$_GET["cartItem"]);
   header("location: index.php");

}else{
   header("location: ../html/login.html");
}
   
     //CART spreichter in jeden Buschstaben in ein index (so ein scheiss!)
?>