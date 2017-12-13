<?php
session_start();
//Öppna anslutning till databas
include_once 'connection.php';

if(isset($_POST['submit'])){
	
	//Hämta globala variabler från POST
	$userNr = $_SESSION['UserId'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	
		//Om användarnamn eller lösenord är tomt
		if(!empty($username) && !empty($password)){
			//Om användarnamne eller lösenord innehåller ogiltiga karaktärer
			if(!preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $password)){
				//Ge felmeddelande
				header("Location: ../anvandaruppgifter.php#RegistreringsFelInvalidYo");
				exit();
			} else {
				
				//SQL fråga för kolla om användarnamnet redan existerar
				$sql = "SELECT * FROM User WHERE userNr='$userNr'";
				
				//Ställ fråga
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				
				//Om användaren finns
				if($result != null){
					//Den SQL fråga som ska ställas till databasen
					$sql = "UPDATE User SET username = '$username', password = '$password', administrator = false WHERE userNr = '$userNr'";

					//Ställ frågan
					$stmt = $conn->prepare($sql);
					$stmt->execute();

					//Skicka användaren tillbaka till startsidan
					header("Location: ../anvandaruppgifter.php");
					exit();
				} else {
					//Ge felmeddelande
					header("Location: ../anvandaruppgifter.php#RegistreringsNoUserExistsYo");
					exit();
				}
			}
		} else {
			//Ge felmeddelande
			header("Location: ../anvandaruppgifter.php#RegistreringsFelEmptyYo");
			exit();
		}
		
} else {
	//Ge felmeddelande
	header("Location: ../anvandaruppgifter.php#Yo");
	exit();
}

?>