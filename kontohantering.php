<!DOCTYPE html>
<html lang="sv">
    <head>
        <meta charset="utf-8">
        <title>Databasteknik Grupp 6</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>

    <body>
	
	<?php
	//Inklucera huvudmenyn
	include_once 'MainNavBar.php';
	?>
	<!-- Division för huvudsakliga innehållet på sidan -->
	<div class="main" id="minMain">
	
	<h3>Formulär:</h3>
	
	<div class="left" id="minLeft">
	<!-- Dessa funktioner är endast tillgängliga från administratörsvyn och hanterar alla olika konton på databasen -->
	<!-- Formulär för att skapa ett nytt konto: -->
	<p> Skapa Konto </p>
	
	<form action="Actions/AdminCreateUser.php" method="POST">
	<input type="text" name="username" placeholder="username">
	<input type="password" name="password" placeholder="password">
	<input type="checkbox" name="admin">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	<!-- Formulär för att ta bort konto från databasen. -->
	<p> Ta bort konto </p>
	
	<form action="Actions/DeleteUser.php" method="POST">
	<input type="text" name="user" placeholder="Användarnummer">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	<!-- Formulär för att uppdatera konto -->
	<p> Uppdatera konto </p>
	
	<form action="Actions/UpdateUser.php" method="POST">
	<input type="text" name="user" placeholder="Användarnummer">
	<input type="text" name="username" placeholder="username">
	<input type="password" name="password" placeholder="password">
	<input type="checkbox" name="admin">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	</div>
	
	<!--
	Visa alla skapade konton.
	-->
	
	<div class="right" id="minRight">
	
	<h3>Konton:</h3>
	
		<?php
		
		//SQL fråga för att hämta information från databasen om användare.
		$sql = "SELECT * FROM User";

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
	</div>
		
    </body>
</html>