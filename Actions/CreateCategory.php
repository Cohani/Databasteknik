<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$name = $_POST['name'];

//Den SQL fråga som ska ställas till databasen
$sql = "insert into Category (name) values ('$name')";
//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_varuhantering.php");

?>