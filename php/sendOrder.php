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
$statement = $mysqli->prepare($sqlUserID);
$statement->execute();
$result = $statement->get_result();
$rowUser = $result->fetch_assoc();

$userID = $rowUser["UserID"];
/*************AUS PRODUKTNAME DIE PRODUKT ID LESEN */
$rowProdukt;
$produktID;
for($i = 0; $i < count($_SESSION["cartItem"]); $i++){
    $produkt =$_SESSION["cartItem"][$i];
    $sqlProduktID = 'SELECT ProduktID FROM BIS_POS_lschmid5.produkt WHERE  BIS_POS_lschmid5.produkt.Produkt_Name = "'. $_SESSION["cartItem"][$i].'"';
    
    $statement = $mysqli->prepare($sqlProduktID);
    $statement->execute();
    $result = $statement->get_result();
    $rowProdukt = $result->fetch_assoc();
    $produktID = $rowProdukt["ProduktID"];
    array_push($_SESSION["pID"],$rowProdukt["ProduktID"]);
    print("<br>". $_SESSION["pID"][$i]." name:".$_SESSION["cartItem"][$i]);
}
$count;
for($i = 0; $i < count($_SESSION["all"]); $i++){
    $count = 0;
 for($j = 0; $j < count($_SESSION["cartItem"]); $j++){
    
    //print("<br>". $_SESSION["cartItem"][$j]." ID:".$produktID);
     if($_SESSION["all"][$i]==$_SESSION["cartItem"][$j]){
        $count++;
     }
     
 }if($count>0){
     $countStr = (string) $count;
    $sqlInsert = "INSERT INTO `BIS_POS_lschmid5`.`bestellungDetails` (`produkt_ProduktID`,`anzahlProdukt`, `user_UserID`, `bestellungDatum`) VALUES (?, ?, ?, NOW())";
    $statement = $mysqli->prepare($sqlInsert);
    $statement->bind_param('isi',  $produktID, $countStr, $userID);
    $statement->execute();
 }
 

}

/*
$sqlInsert = "NSERT INTO `BIS_POS_lschmid5`.`bestellungDetails` (`produkt_ProduktID`,`anzahlProdukt`, `user_UserID`, `bestellungDatum`) VALUES (?, ?, ?, NOW())";
$statement = $mysqli->prepare($sql);
$statement->bind_param('isi',  $produktID, $anzahl, $userID);
*/
?>