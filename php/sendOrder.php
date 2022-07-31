<?php
session_start();
$_SESSION["pID"] = array();
$mysqli = new mysqli('141.79.25.220', 'lschmid5', 'abc123', 'BIS_POS_lschmid5');
if ($mysqli->connect_errno) {
	die('Verbindung fehlgeschlagen: ' . $mysqli->connect_error);
}
/****** AUS USER NAME DIE USER ID RAUSLESEN */
$user = $_SESSION["username"];
$sqlUserID = 'SELECT UserID FROM BIS_POS_lschmid5.user WHERE  BIS_POS_lschmid5.user.User_name = "'.$user.'"';
echo $sqlUserID;
print_r($_SESSION["cartItem"]); 
$statement = $mysqli->prepare($sqlUserID);
$statement->execute();
$result = $statement->get_result();
$rowUser = $result->fetch_assoc();

$userID = $rowUser["UserID"];
/*************AUS PRODUKTNAME DIE PRODUKT ID LESEN */
$rowProdukt;
$produktID;

$j =0;
while($j < count($_SESSION["cartItem"])){
     
   
 
    $produkt = $_SESSION["cartItem"][$j];
    $sqlProduktID = 'SELECT ProduktID FROM BIS_POS_lschmid5.produkt WHERE  BIS_POS_lschmid5.produkt.Produkt_Name = "'.$produkt.'"';
    $statement = $mysqli->prepare($sqlProduktID);
    $statement->execute();
    $result = $statement->get_result();
    $rowProdukt = $result->fetch_assoc();
    $produktID = $rowProdukt["ProduktID"];
    print("<br> UserID: ".$userID);
    print("<br> ProduktID: ".$produktID);
    array_push($_SESSION["pID"], $produktID);
 


    
    $sqlInsert = "INSERT INTO `BIS_POS_lschmid5`.`bestellungDetails` (`produkt_ProduktID`, `user_UserID`, `bestellungDatum`) VALUES (?, ?, NOW())";
    $statement = $mysqli->prepare($sqlInsert);
    $statement->bind_param('ii',  $produktID,  $userID);
    $statement->execute();

   $j++; }
 
  

 
//}
print("<br>");
print_r($_SESSION["pID"]);
/*
$sqlInsert = "NSERT INTO `BIS_POS_lschmid5`.`bestellungDetails` (`produkt_ProduktID`,`anzahlProdukt`, `user_UserID`, `bestellungDatum`) VALUES (?, ?, ?, NOW())";
$statement = $mysqli->prepare($sql);
$statement->bind_param('isi',  $produktID, $anzahl, $userID);
*/
?>
