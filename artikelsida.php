<!DOCTYPE html>
<html lang="sv">
    <head>
        <meta charset="utf-8">
        <title>Databasteknik Grupp 6</title>
		<link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>

    <body>
	
	<?php
	include_once 'MainNavBar.php';
	?>
	
	<div class="main" id="minMain">
	
	<?php
	
	//Om användaren har valt en artikel i katalogen
	if(isset($_SESSION['articleId'])){
		$articleNr = $_SESSION['articleId'];
	} else {
		//Annars skicka tillbaka användaren till katalogen
		header("Location: ../index.php");
	}
	
	//Hämtar den aktuella artikeln
	$sql = "SELECT * FROM Article WHERE articleNr='$articleNr'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch();
	
	//Skriver ut namnet och artikelnumret som titel på sidan
	echo "<h2>" . $result['articleNr'] . " " . $result['name'] . "</h2>";
	
	//Om artikeln har en bild
	if($result['image'] != null){
		//Visa bilden
		echo "<img src='" . $result['image'] . "'>";
	}
	//Skriv ut information om artikeln
	echo "<h4> Specifikationer: </h4>";
	echo "<p> Färg: " . $result['color'] ."</p>";
	echo "<p> Diameter: " . $result['diameter'] ."cm</p>";
	echo "<p> Pris: " . $result['price'] ."kr</p>";
	echo "<h4> Beskrivning: </h4>";
	echo "<p>" . $result['description'] . "</p>";
	
	
	?>
	
	<?php
	//om användaren är inloggad
	if(isset($_SESSION['UserId'])){
		
	//Skriv ut formulär för att lägga till artikeln i kundvagnen.
	echo "<form action='Actions/addToCart.php' method='POST'>";
	echo "<input type='number' name='quantity' min='1'>";
	echo "<button type='submit' name='articleNr' value='" . $articleNr . "'>Lägg till</button><br>";
	echo "</form> <br>";
	
	//skriv ut formulär för att posta kommentar
	echo "<form action='Actions/postComment.php' method='POST'>";
		
	echo "<input type='text' name='title' placeholder='Rubrik'> Betyg";
		
	echo "<select name='score'>";
	echo "<option value='0'>0</option>";
	echo "<option value='1'>1</option>";
	echo "<option value='2'>2</option>";
	echo "<option value='3'>3</option>";
	echo "<option value='4'>4</option>";
	echo "<option value='5'>5</option>";
	echo "</select><br>";
		
	echo "<textarea name='text' rows='10' cols='30'></textarea>";
		
	echo "<button type='submit' name='submit'>Skicka</button>";
		
	echo "</form>";
	
	
	
	} else {
		//Om användaren inte är inloggad be dem logga in
		echo "<p> logga in för att köpa och skriva kommentarer. </p>";
	}
	?>
	
		<div class="comment" id="minComment">
	
	<?php
	
		//Variabler för att beräkna medelbetyg
		$totalScore = 0;
		$count = 0;
		$avgScore = 0;
		
		//Hämta artikelns kommentarer
		$sql = "SELECT * FROM Comment INNER JOIN User ON Comment.userNr = User.userNr WHERE articleNr='$articleNr'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		//Skriv ut varje kommentar
		foreach($result as $row){
			//Addera betygen till totalen
			$totalScore = $totalScore + $row['score'];
			//Antal kommentarer
			$count = $count + 1;
			//Kommenterers innehåll
			echo "<h4>" . $row['title'] . " Betyg: " . $row['score'] . "/5" . "</h4>";
			echo "<p>" . $row['text'] . "</p>";
			echo "<p>/" . $row['username'] . " - " . $row['date'] . "</p>";
		}
		
		//Om artikeln har kommentarer med betyg
		if($result != null){
			//Räkna ut medelbetyg
			$avgScore = $totalScore / $count;
			echo "<p>Medelbetyg: " . $avgScore . "</p>" ;
		}
	
	?>
	
	</div>
	</div>
		
    </body>
</html>