<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$category = $_POST['category'];
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$color= $_POST['color'];
$diameter = $_POST['diameter'];
$weight = $_POST['weight'];


//Den SQL fråga som ska ställas till databasen
$sql = "insert into Article (categoryNr, name, description, price, color, diameter, weight) values ('$category', '$name', '$description', '$price', '$color', '$diameter', '$weight')";
//Ställ frågan
$conn->exec($sql);

//Skicka användaren tillbaka till startsidan
header("Location: ../utv_varuhantering.php");

?>