<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$userNr = $_POST['user'];

//SQL för att ta bort användare
$sql = "DELETE FROM User WHERE userNr = '$userNr'";
//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_kontohantering.php");

?>