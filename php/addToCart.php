<?php
session_start();

/*$mysqli = new mysqli('141.79.25.220', 'lschmid5', 'abc123', 'BIS_POS_lschmid5');
if ($mysqli->connect_errno) {
	die('Verbindung fehlgeschlagen: ' . $mysqli->connect_error);
}*/
if(count($_SESSION["cartItem"]) < 1){
$_SESSION["cartItem"] = array();
}else{
   array_push($_SESSION["cartItem"],$_GET["cartItem"]);
}

 /*   $sql = "INSERT INTO `BIS_POS_lschmid5`.`bestellungDetails` (produkt_ProduktID, warenkorbID, user_UserID) VALUES (?, ?, ?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('sss',  $user, $pass, $email);
    $_GET["cart"];
    
    $statement->execute();
    */

     print_r($_SESSION["cartItem"]);

   // header("location: index.php");
     //CART spreichter in jeden Buschstaben in ein index (so ein scheiss!)
?>