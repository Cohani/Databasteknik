<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Om användaren kom till scriptet genom att trycka på knappen submit
if(isset($_POST['submit'])){
	
	//Hämta variabler från POST
	$userNr = $_POST['user'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$admin = $_POST['admin'];

	//Om användarnamn eller lösenord är tomt
		if(!empty($username) && !empty($password) && !empty($userNr)){
			//Om användarnamne eller lösenord innehåller ogiltiga karaktärer
			if(!preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $password)){
				//Ge felmeddelande
				header("Location: ../kontohantering.php#RegistreringsFelInvalidYo");
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
					//Om administratörkont är ikryssat
					if($admin != null){
						//SQL fråga för att uppdatera administratörkonto
						$sql = "UPDATE User SET username = '$username', password = '$password', administrator = true WHERE userNr = '$userNr'";
					} else{
						//SQL fråga för att uppdatera kundkonto
						$sql = "UPDATE User SET username = '$username', password = '$password', administrator = false WHERE userNr = '$userNr'";
					}
				
					//Ställ frågan
					$stmt = $conn->prepare($sql);
					$stmt->execute();
			
					//Skicka tillbaka användaren
					header("Location: ../kontohantering.php");
					exit();
				} else {
					//Ge felmeddelande
					header("Location: ../kontohantering.php#RegistreringsNoUserExistsYo");
					exit();
				}
			}
		} else {
			//Ge felmeddelande
			header("Location: ../kontohantering.php#RegistreringsFelEmptyYo");
			exit();
		}
		
} else {
	//Ge felmeddelande
	header("Location: ../kontohantering.php#Yo");
	exit();
}

?>