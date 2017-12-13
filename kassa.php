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
	
	//Göm kundvagn
	$_SESSION['showCart'] = false;
	
	echo "<h3>Kundvagn</h3>";
	
			//Variabler för att räkna total pris för ordern
			$total = 0;
			$product = 0;
			
			//Hämta den aktuella ordern
			$orderNr = $_SESSION['currentOrder'];
			$sql = "SELECT * FROM Article INNER JOIN ArticlesInOrder ON Article.articleNr = ArticlesInOrder.articleNr WHERE orderNr='$orderNr'";
			$stmt = $conn->prepare($sql);
			$stmt->execute();
			$result = $stmt->fetchAll();
			
			//Skriv ut varje artikel i ordern inom ett formulär för att ta bort artikeln från ordern
			echo "<form action='Actions/deleteItemFromCart.php' method='POST'>";
			
			foreach($result as $row){
				
				echo "<button type='submit' name='submit' value='" . $row['articleNr'] . "'>" . $row['name'] . " " . $row['quantity'] . "x</button><br>";
				
				$total = $total + $row['subTotal'];
			}
			
			echo "</form>";
			
			//Skriv ut total priset
			echo "Totalt: " . $total . "kr<br>";
			//Länk för att placera ordern
			echo "<a href='Actions/createOrder.php'> Beställ </a>";
	
	?>
	
	
	</div>
	
    </body>
</html>