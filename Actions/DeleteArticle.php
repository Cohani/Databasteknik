<?php
//Öppna anslutning till databas
include_once 'connection.php';

if(isset($_POST['submit'])){
//Hämta globala variabler från POST
$articleNr = $_POST['article'];

//SQL för att ta bort artikel
$sql = "UPDATE Article SET available=false WHERE articleNr = '$articleNr'";
//Ställ frågan
$stmt = $conn->prepare($sql);
$stmt->execute();

//Skicka användaren tillbaka till startsidan
header("Location: ../varuhantering.php");
exit();

} else {
header("Location: ../varuhantering.php#Yo");
exit();
}

?>