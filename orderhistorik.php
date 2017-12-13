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
	
	<h3>Mina ordrar:</h3>
	
	<?php
	
		//Hämta alla den nuvarande användarens ordrar
		$uid = $_SESSION['UserId'];
		$sql = "SELECT * FROM `Order` INNER JOIN ArticlesInOrder ON `Order`.orderNr = ArticlesInOrder.orderNr INNER JOIN Article ON ArticlesInOrder.articleNr = Article.ArticleNr WHERE userNr='$uid' AND finalized=true";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		//Skriv ut information om varje order
		foreach($result as $row){
		        echo "<p> OrderNr: " . $row['orderNr'] . " UserNr: " . $row['userNr'] . " ArticleNr: " . $row['articleNr'] . " Article: " . $row['name'] ." Quantity: " . $row['quantity'] . "</p>";
	
			echo "<br>";
		}
	
	?>
	
	</div>
		
    </body>
</html>
