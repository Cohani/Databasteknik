<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$categoryNr = $_POST['category'];

//SQL för att ta bort alla artiklar i kategorin
$sql = "DELETE FROM Article WHERE categoryNr = '$categoryNr'";
//Ställ frågan
$conn->exec($sql);

//SQL för att ta bort kategorin
$sql = "DELETE FROM Category WHERE categoryNr = '$categoryNr'";
//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_varuhantering.php");

?>