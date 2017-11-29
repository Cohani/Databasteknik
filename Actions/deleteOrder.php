<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$orderNr = $_POST['ordernr'];

//SQL för att ta bort alla artiklar i kategorin
$sql = "DELETE FROM ArticlesInOrder WHERE orderNr = '$orderNr'";
//Ställ frågan
$conn->exec($sql);

//SQL för att ta bort kategorin
$sql = "DELETE FROM `Order` WHERE orderNr = '$orderNr'";
//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_orderhantering.php");

?>