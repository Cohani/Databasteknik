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
		//Hämta sortiment
		$sql = "SELECT * FROM Article WHERE available=true";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		echo "<form action='Actions/selectArticle.php' method='post'>";
		
		//Skriv ut information om varje artikel i sortiment
		foreach($result as $row){
			
			echo "<button type='submit' name='articleNr' value='" . $row['articleNr'] . "'>" . $row['name'] . "</button><br>";
		}
		
		echo "</form>";
	
	?>
	
	
	</div>
		
    </body>
</html>