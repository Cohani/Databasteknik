<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Om användaren kom till scriptet genom att trycka på knappen submit
if(isset($_POST['submit'])){
	
	//Hämta variabler från POST
	$username = $_POST['username'];
	$password = $_POST['password'];
	$admin = $_POST['admin'];

	//Om användarnamn eller lösenord är tomt
		if(!empty($username) && !empty($password)){
			//Om användarnamne eller lösenord innehåller ogiltiga karaktärer
			if(!preg_match("/^[a-zA-Z0-9]*$/", $username) || !preg_match("/^[a-zA-Z0-9]*$/", $password)){
				//Ge felmeddelande
				header("Location: ../registrera.php#RegistreringsFelInvalidYo");
				exit();
			} else {
				
				//SQL fråga för kolla om användarnamnet redan existerar
				$sql = "SELECT * FROM User WHERE username='$username'";
				
				//Ställ fråga
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				
				//Om inga användare med samma användarnamn hittades
				if($result == null){
					//Om administratörkont är ikryssat
					if($admin != null){
						//SQL fråga för att skapa administratörkonto
						$sql = "INSERT INTO User (username, password, administrator) VALUES ('$username', '$password', true)";
					} else{
						//SQL fråga för att akapa kundkonto
						$sql = "INSERT INTO User (username, password, administrator) VALUES ('$username', '$password', false)";
					}
				
					//Ställ frågan
					$stmt = $conn->prepare($sql);
					$stmt->execute();
			
					//Skicka tillbaka användaren
					header("Location: ../registrera.php");
					exit();
				} else {
					//Ge felmeddelande
					header("Location: ../registrera.php#RegistreringsUserExistsYo");
					exit();
				}
			}
		} else {
			//Ge felmeddelande
			header("Location: ../registrera.php#RegistreringsFelEmptyYo");
			exit();
		}
		
} else {
	//Ge felmeddelande
	header("Location: ../registrera.php#Yo");
	exit();
}
?>