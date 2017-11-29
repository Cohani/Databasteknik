<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$article = $_POST['article'];
$category = $_POST['category'];
$name = $_POST['name'];
$description = $_POST['description'];
$image = $_POST['image'];
$price = $_POST['price'];
$color= $_POST['color'];
$diameter = $_POST['diameter'];
$wieght = $_POST['weight'];

//Den SQL fråga som ska ställas till databasen
$sql = "UPDATE Article SET categoryNr = '$category', name = '$name', description = '$description', image = '$image', price = '$price', color = '$color', diameter = '$diameter', weight = '$weight' WHERE articleNr = '$article'";

//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_varuhantering.php");

?>