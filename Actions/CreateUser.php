<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$username = $_POST['username'];
$password = $_POST['password'];
$admin = $_POST['admin'];

if($admin != null){
	$sql = "INSERT INTO User (username, password, administrator) VALUES ('$username', '$password', true)";
} else{
	$sql = "INSERT INTO User (username, password, administrator) VALUES ('$username', '$password', false)";
}
//Den SQL fråga som ska ställas till databasen
//Ställ frågan
$conn->exec($sql);

//echo " <br> Administratör: " . $username . " Skapad"

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_registrera.php");

?>