<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$articleNr = $_POST['article'];

//SQL för att ta bort artikel
$sql = "DELETE FROM Article WHERE articleNr = '$articleNr'";
//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_varuhantering.php");

?>