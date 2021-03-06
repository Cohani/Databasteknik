<?php
//Öppna anslutning till databas
include_once 'connection.php';

if(isset($_POST['submit'])){
	//Hämta globala variabler från POST
	$username = $_POST['username'];
	$password = $_POST['password'];

	//SQL fråga för att hitta användare med specifikt användarnamn
	$sql = "SELECT * FROM User WHERE username='$username'";
	//Ställ frågan
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch();

	//Om användare hittades
	if($result != null){
		//Om lösenordet är rätt
		if($result['password'] == $password){
			//Påbörja en session
			session_start();
			//Sätt Användarens userNr som den nuvarande sessionens userId. För hela hemsidan skiljs databas variabler med Nr och session variabler med Id.
			$_SESSION['UserId'] = $result['userNr'];
			$userNr = $result['userNr'];
			
			//SQL fråga för att hämta användarens aktuella order som kundvagn
			$sql = "SELECT * FROM `Order` WHERE userNr='$userNr' AND finalized=false";
			//Ställ frågan
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetch();
		
			//Om en aktuell order fanns
			if($result != null){
				//Sätt ordern som nuvarande order
				$_SESSION['currentOrder'] = $result['orderNr'];
			} else {
				//Om ingen order hittades
				//Skapa en ny order som användarens aktuella kundvagn
				$sql = "insert into `Order` (userNr, finalized) values ( '$userNr', false)";
				$conn->exec($sql);
				$_SESSION['currentOrder'] = $conn->lastInsertId();
			}
			
			//Skicka tillbaka användaren
			header("Location: ../index.php");
			exit();
		} else {
			//Ge felmeddelande
			header("Location: ../index.php#FelPasswordYo");
			exit();
		}
	} else{
		//Ge felmeddelande
		header("Location: ../index.php#InvalidUserYo");
		exit();
	}
}
 else {
	//Ge felmeddelande
	header("Location: ../index.php#Yo");
	exit();
}
?>