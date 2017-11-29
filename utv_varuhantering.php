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
	
	?>
	
	<div class="left" id="minLeft">
	
	<p> Lägg till kategori </p>
	
	<form action="Actions/CreateCategory.php" method="POST">
	<input type="text" name="name" placeholder="namn">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	<p> Ta bort kategory (Och alla varor i den kategorin) </p>
	
	<form action="Actions/DeleteCategory.php" method="POST">
	<input type="text" name="category" placeholder="categori nummer">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	<!--
	Formulär för att lägga till en ny artikel.
	Categori nummer krävs vid skapande av artiklar!
	-->
	
	<p> Lägg till vara </p>
	
	<form action="Actions/CreateArticle.php" method="POST">
	<input type="text" name="category" placeholder="kategori nummer"><br>
	<input type="text" name="name" placeholder="namn"><br>
	<input type="text" name="description" placeholder="beskrivning"><br>
	<input type="text" name="price" placeholder="pris"><br>
	<input type="text" name="color" placeholder="färg"><br>
	<input type="text" name="diameter" placeholder="diameter"><br>
	<input type="text" name="weight" placeholder="vikt"><br>
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
	<input type="text" name="category" placeholder="kategori nummer"><br>
	<input type="text" name="name" placeholder="namn"><br>
	<input type="text" name="description" placeholder="beskrivning"><br>
	<input type="text" name="price" placeholder="pris"><br>
	<input type="text" name="color" placeholder="färg"><br>
	<input type="text" name="diameter" placeholder="diameter"><br>
	<input type="text" name="weight" placeholder="vikt"><br>
	<input type="text" name="image" placeholder="filväg till bil (Bilder/bildnamn)"><br>
	<button type="submit" name="submit"> skicka </button>
	</form>
	</div>
	
	<div class="right" id="minRight">
	
	<!--
	Visa alla nuvarande kategorier i databasen.
	-->
	
	<h3>Kategorier:</h3>
	
	<br>
		
		<?php
		
		$sql = "SELECT * FROM Category";

		echo "<br>";

		foreach($conn->query($sql) as $row){
			echo $row['categoryNr'] . " ";
			echo $row['name'];
	
			echo "<br>";
		}
		
		?>
	
	<br>
	
	<!--
	Lista upp alla nuvarande artiklar i databasen.
	-->
	
		<br>
		
		<h3>Artiklar:</h3>
		
		<?php
		
		$sql = "SELECT * FROM Article";

		echo "<br>";

		foreach($conn->query($sql) as $row){
			echo $row['articleNr'] . " ";
			echo $row['categoryNr'] . " ";
			echo $row['name'] . " ";
			echo $row['description'];
			
			if($row['image'] != null){
				echo " " . $row['image'];
			}
	
			echo "<br>";
		}
		
		?>
		
		</div>
		
		<?php
		$conn = null;
		?>
	
	
	</div>
		
    </body>
</html>