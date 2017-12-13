<!DOCTYPE html>
<html lang="sv">
    <head>
        <meta charset="utf-8">
        <title>Databasteknik Grupp 6</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>

    <body>
	
	<?php
	//Inkludera huvudmenyn på sidans topp.
	include_once 'MainNavBar.php';
	?>
	
	<!--
	mainClass innehåller allt innehåll på sidan som inte är menyn.
	-->
	<div class="main" id="minMain">
	
	<h1>Registrera konto:</h1>
	
	<!--
	För att skapa ett konto krävs användarnamn(username) lösenord(password).
	Alternativt om kontot ska vara ett administratörkonto eller kundkonta så kan kryssrutan markeras.
	
	Engelska namn används för att slippa åäö.
	-->
	<form action="Actions/CreateUser.php" method="POST">
	<input type="text" name="username" placeholder="username">
	<input type="password" name="password" placeholder="password">
	<input type="checkbox" name="admin">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	<h1> Nuvarande konton: </h1>
		
		<?php
		
		//SQL för att hämta alla konton.
		$sql = "SELECT * FROM User";
		
		/*
		Sidan listar upp alla konton inklusive lösenord för att underlätta vid testning.
		*/
		
		//Ställ frågan till databasen
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		//Gå igenom varje rad i frågans resultat.
		foreach($result as $row){
			
			//Om kontot är administratör:
			if($row['administrator']){
				echo "<p class='admin'>" . $row['userNr'] . " " . $row['username'] . " " . $row['password'] . "</p>";
			} else {
				echo "<p>" . $row['userNr'] . " " . $row['username'] . " " . $row['password'] . "</p>";
			}
		}
		
		?>
		
	</div>
	
    </body>
</html>