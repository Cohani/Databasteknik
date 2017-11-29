<?php
session_start();
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$uid = $_SESSION['UserId'];
$username = $_POST['username'];
$password = $_POST['password'];

//Den SQL fråga som ska ställas till databasen
$sql = "UPDATE User SET username = '$username', password = '$password', administrator = false WHERE userNr = '$uid'";

//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_anvandaruppgifter.php");

?>