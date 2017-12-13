<?php
//Öppna anslutning till databas
include_once 'connection.php';

if(isset($_POST['submit'])){
//Hämta globala variabler från POST
$name = $_POST['name'];
$description = $_POST['description'];
$price = $_POST['price'];
$color= $_POST['color'];
$diameter = $_POST['diameter'];

//Om om något fält inte är ifyllt
if(!empty($name) && !empty($description) && !empty($price) && !empty($color) && !empty($diameter)){
	//om diameter och pris inte innehåller bokstäver
	if(preg_match("/^[0-9]*$/", $price) && preg_match("/^[0-9]*$/", $diameter)){
		//Lägg in artikeln i databasen
		$sql = "insert into Article (name, description, price, color, diameter, available) values ( '$name', '$description', '$price', '$color', '$diameter', true)";
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