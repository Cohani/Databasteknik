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
	
	<!--
	Centrera sidans innehåll
	-->
	
	<div class="left" id="minLeft">
	
	<!--
	Lista upp alla formulär till vänster om sidan.
	-->
	
	<h3>Formulär:</h3>
	
	<p> Lägg till vara </p>
	
	<form action="Actions/CreateArticle.php" method="POST">
	<input type="text" name="name" placeholder="namn"><br>
	<input type="text" name="description" placeholder="beskrivning"><br>
	<input type="text" name="price" placeholder="pris"><br>
	<input type="text" name="color" placeholder="färg"><br>
	<input type="text" name="diameter" placeholder="diameter"><br>
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	<p> Ta bort vara </p>
	
	<form action="Actions/DeleteArticle.php" method="POST">
	<input type="text" name="article" placeholder="artikelnummer">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	<p> Updatera vara </p>
	
	<form action="Actions/UpdateArticle.php" method="POST">
	<input type="text" name="article" placeholder="artikelnummer"><br>
	<input type="text" name="name" placeholder="namn"><br>
	<input type="text" name="description" placeholder="beskrivning"><br>
	<input type="text" name="price" placeholder="pris"><br>
	<input type="text" name="color" placeholder="färg"><br>
	<input type="text" name="diameter" placeholder="diameter"><br>
	<input type="text" name="image" placeholder="filväg till bil (Bilder/bildnamn)"><br>
	<button type="submit" name="submit"> skicka </button>
	</form>
	</div>
	
	<div class="right" id="minRight">
	
	<!--
	Lista upp alla nuvarande artiklar i databasen till höger om sidan.
	-->
		
		<h3>Artiklar:</h3>
		
		<?php
		
		// Hämta alla artiklar från databasen
		$sql = "SELECT * FROM Article";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		//Skriv ut information för varje artikel
		foreach($result as $row){
			
			if($row['image'] != null){
				if($row['available']){
					echo "<p>" . $row['articleNr'] . " " . $row['name'] . " " . $row['image'] . "</p>";
				} else {
					echo "<p class='unavailable'>" . $row['articleNr'] . " " . $row['name'] . " " . $row['image'] . "</p>";
					
				}
			} else {
				if($row['available']){
					echo "<p>" . $row['articleNr'] . " " . $row['name'] . "</p>";
				} else {
					echo "<p class='unavailable'>" . $row['articleNr'] . " " . $row['name'] . "</p>";
					
				}
			}
		}
		
		?>
		
		</div>
	</div>
		
    </body>
</html>