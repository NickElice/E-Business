<?php

/*$mysqli = new mysqli('141.79.25.220', 'lschmid5', 'abc123', 'BIS_POS_lschmid5');
if ($mysqli->connect_errno) {
	die('Verbindung fehlgeschlagen: ' . $mysqli->connect_error);
}*/
   $cart=  $_GET['cart'];
 /*   $sql = "INSERT INTO `BIS_POS_lschmid5`.`bestellungDetails` (produkt_ProduktID, warenkorbID, user_UserID) VALUES (?, ?, ?)";
    $statement = $mysqli->prepare($sql);
    $statement->bind_param('sss',  $user, $pass, $email);
    $_GET["cart"];
    
    $statement->execute();
    */

     echo $cart;
     //CART spreichter in jeden Buschstaben in ein index (so ein scheiss!)
?>