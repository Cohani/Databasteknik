<?php
//Öppna anslutning till databas
include_once 'connection.php';

if(isset($_POST['submit'])){
	
//Hämta globala variabler från POST
$article = $_POST['article'];
$name = $_POST['name'];
$description = $_POST['description'];
$image = $_POST['image'];
$price = $_POST['price'];
$color= $_POST['color'];
$diameter = $_POST['diameter'];
	
//Om om något fält inte är ifyllt
if(!empty($name) && !empty($description) && !empty($price) && !empty($color) && !empty($diameter)){
	//om diameter och pris inte innehåller bokstäver
	if(preg_match("/^[0-9]*$/", $price) && preg_match("/^[0-9]*$/", $diameter)){
		//Lägg in artikeln i databasen
		$sql = "UPDATE Article SET  name = '$name', description = '$description', image = '$image', price = '$price', color = '$color', diameter = '$diameter', available=true WHERE articleNr = '$article'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();

		//Skicka tillbaka användaren
		header("Location: ../varuhantering.php");
		exit();
	} else {
		//Ge felmeddelande
		header("Location: ../varuhantering.php#Invalid");
		exit();
	}
} else {
	//Ge felmeddelande
	header("Location: ../varuhantering.php#Empty");
	exit();
}
}
?>