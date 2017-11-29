<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$userNr = $_POST['user'];
$username = $_POST['username'];
$password = $_POST['password'];
$admin = $_POST['admin'];

//Den SQL fråga som ska ställas till databasen

if($admin != null){
	$sql = "UPDATE User SET username = '$username', password = '$password', administrator = true WHERE userNr = '$userNr'";
} else {
	$sql = "UPDATE User SET username = '$username', password = '$password', administrator = false WHERE userNr = '$userNr'";
}

//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_kontohantering.php");

?>