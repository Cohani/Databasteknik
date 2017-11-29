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
	if(isset($_SESSION['UserId'])){
		$uid = $_SESSION['UserId'];
		$sql = "SELECT * FROM User WHERE userNr='$uid'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		echo "<h2> Välkommen " . $result['username'] . "! </h2>";
		if($result['administrator']){
		}
	} else {
		
		echo "<h2> Välkommen du är inte inloggad! </h2>";
		
	}
	
	if(isset($_SESSION['articleId'])){
		$articleNr = $_SESSION['articleId'];
	} else {
		//Felhantering!!
		header("Location: ../utv_index.php");
	}
	
	$sql = "SELECT * FROM Article WHERE articleNr='$articleNr'";
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$result = $stmt->fetch();
	
	echo "<h2>" . $result['articleNr'] . " " . $result['name'] . "</h2>";
	
	if($result['image'] != null){
		echo "<img src='" . $result['image'] . "'>";
	} else{
	}
	echo "<h4> Specifikationer: </h4>";
	echo "<p> Färg: " . $result['color'] ."</p>";
	echo "<p> Diameter: " . $result['diameter'] ."cm</p>";
	echo "<p> Vikt: " . $result['weight'] ."kg</p>";
	echo "<p> Pris: " . $result['price'] ."kr</p>";
	echo "<h4> Beskrivning: </h4>";
	echo "<p>" . $result['description'] . "</p>";
	
	
	?>
	
	<form action="Actions/addToCart.php" method="POST">
	<input type="text" name="quantity" placeholder="1">
	
	<?php
	echo "<button type='submit' name='articleNr' value='" . $articleNr . "'>Lägg till</button><br>";
	?>
	</form>
	
		<div class="comment" id="minComment">
	
	<?php
	
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
		
		
		$sql = "SELECT * FROM Comment INNER JOIN User ON Comment.userNr = User.userNr WHERE articleNr='$articleNr'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		foreach($result as $row){
			echo "<h4>" . $row['title'] . " Betyg: " . $row['score'] . "/5" . "</h4>";
			echo "<p>" . $row['text'] . "</p>";
			echo "<p>/" . $row['username'] . "</p>";
		}
		
	
	?>
	
	</div>
	
	</div>
		
    </body>
</html>