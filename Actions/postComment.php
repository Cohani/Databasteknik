<?php
//Öppna anslutning till databas
include_once 'connection.php';

session_start();

//Hämta globala variabler från POST
$title = $_POST['title'];
$score = $_POST['score'];
$text = $_POST['text'];

$articleNr = $_SESSION['articleId'];
$uid = $_SESSION['UserId'];


//Den SQL fråga som ska ställas till databasen
$sql = "insert into Comment (userNr, articleNr, title, text, score) values ('$uid', '$articleNr', '$title', '$text', '$score')";
//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_artikelsida.php");

?>