<?php
session_start();
$mysqli = new mysqli('141.79.25.220', 'lschmid5', 'abc123', 'BIS_POS_lschmid5');
if ($mysqli->connect_errno) {
	die('Verbindung fehlgeschlagen: ' . $mysqli->connect_error);
}


//Kategorien für die Navbar
print("<body>");
for($i = 0; $i < count($_SESSION["cartItem"]); $i++){
$sql= 'SELECT * FROM BIS_POS_lschmid5.produkt WHERE  BIS_POS_lschmid5.produkt.Produkt_Name = "'. $_SESSION["cartItem"][$i].'"';
//print($sql."<br>");

$statement = $mysqli->prepare($sql);
$statement->execute();
$result = $statement->get_result();

while($rowCartItem = $result->fetch_assoc()){
  //  print($rowCartItem["Produkt_Name"]."<br><img class='card-img-top' src='".$rowCartItem["Bild_Path"]."'><br>");

    print(" <div class='col-md-8 cart'>
                        <div class='title'>
                            <div class='row'>
                                <div class='col'><h4><b>Shopping Cart</b></h4></div>
                                <div class='col align-self-center text-right text-muted'>3 items</div>
                            </div>
                        </div>    
                        <div class='row border-top border-bottom'>
                            <div class='row main align-items-center'>
                                <div class='col-2'><img class='img-fluid' src='".$rowCartItem["Bild_Path"]."'></div>
                                <div class='col'>
                         
                                    <div class='row'>".$rowCartItem["Produkt_Name"]."</div>
                                </div>
                                <div class='col'>
                                 
                                </div>
                                <div class='col'>".$rowCartItem["Preis"]."<span class='close'>✕</span></div>
                            </div>
                        </div>
                      
                        <div class='back-to-shop'><a href='../php/index.php'>←</a><span class='text-muted'>Back to shop</span></div>
                    </div>");
                   
}
}
print("</body>");
?>