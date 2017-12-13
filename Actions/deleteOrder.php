<?php
//Öppna anslutning till databas
include_once 'connection.php';

if(isset($_POST['submit'])){
//Hämta globala variabler från POST
$orderNr = $_POST['ordernr'];

//SQL för att ta bort alla artiklar i kategorin
$sql = "DELETE FROM ArticlesInOrder WHERE orderNr = '$orderNr'";
//Ställ frågan
$stmt = $conn->prepare($sql);
$stmt->execute();

//SQL för att ta bort kategorin
$sql = "DELETE FROM `Order` WHERE orderNr = '$orderNr'";
//Ställ frågan
$stmt = $conn->prepare($sql);
$stmt->execute();

//Skicka tillbaka användaren
header("Location: ../orderhantering.php");
exit();
} else {
header("Location: ../orderhantering.php#Yo");
exit();
}

?>