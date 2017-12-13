<?php
//Öppna anslutning till databas
include_once 'connection.php';

session_start();

if(isset($_POST['submit'])){
//Hämta globala variabler från POST
$title = $_POST['title'];
$score = $_POST['score'];
$text = $_POST['text'];

$articleNr = $_SESSION['articleId'];
$uid = $_SESSION['UserId'];

//Hämta dagens datum
$date = date("Y-m-d H:i:s");

//Den SQL fråga som ska ställas till databasen
$sql = "insert into Comment (userNr, articleNr, title, text, score, date) values ('$uid', '$articleNr', '$title', '$text', '$score', '$date')";
//Ställ frågan
$stmt = $conn->prepare($sql);
$stmt->execute();

//Skicka tillbaka användaren
header("Location: ../artikelsida.php");
exit();
} else {
header("Location: ../artikelsida.php#Yo");
exit();
}

?>