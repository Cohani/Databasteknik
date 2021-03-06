<?php
//Öppna anslutning till databas
include_once 'connection.php';
session_start();

//Hämta globala variabler
$uid = $_SESSION['UserId'];
$orderNr = $_SESSION['currentOrder'];

//Uppdatera den aktulla ordern och sätt finalized till sann för att markera att den är placerad
$sql = "UPDATE `Order` SET finalized=true WHERE orderNr = '$orderNr' AND userNr ='$uid'";
$stmt = $conn->prepare($sql);
$stmt->execute();

//Skapa en ny order som kundvagn
$sql = "insert into `Order` (userNr, finalized) values ( '$uid', false)";
$stmt = $conn->prepare($sql);
$stmt->execute();

//Uppdatera session varabel för aktuell order med den senaste som skapades i databasen
$_SESSION['currentOrder'] = $conn->lastInsertId();

//Skicka tillbaka användaren
header("Location: ../index.php");
exit();


?>