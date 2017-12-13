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
	<p> Lista specifik Order </p>
	
	<form action="Actions/listaOrder.php" method="POST">
	<input type="text" name="ordernr" placeholder="Ordernummer">
	<button type="submit" name="submit"> skicka </button>
	</form>

	<?php
	   if(isset($_SESSION['orderId'])){
	        $orderId = $_SESSION['orderId'];
	         	
		//Hämta den aktuella ordern från databasen
		$sql = "SELECT * FROM `Order` INNER JOIN ArticlesInOrder ON `Order`.orderNr = ArticlesInOrder.orderNr INNER JOIN Article ON ArticlesInOrder.articleNr = Article.ArticleNr WHERE `Order`.orderNr = '$orderId' AND finalized=true";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		//Skriv ut information om den aktuella ordern
		foreach($result as $row){
			echo "<p> OrderNr: " . $row['orderNr'] . " UserNr: " . $row['userNr'] . " ArticleNr: " . $row['articleNr'] . " Article: " . $row['name'] ." Quantity: " . $row['quantity'] . "</p>";
		}   
	   }
	?>
	
	<!-- Formulär för att ta bort konto från databasen. -->
	<p> Ta bort Order </p>
	
	<form action="Actions/deleteOrder.php" method="POST">
	<input type="text" name="ordernr" placeholder="Ordernummer">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	</div>
	
	<!--
	Visa alla skapade konton.
	-->
	
	<div class="right" id="minRight">
	
	<h3>Orders:</h3>
		
		<?php
		
		//SQL fråga för att hämta information från databasen om användare.
		$sql = "SELECT * FROM `Order`";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll();

		foreach($result as $row){
			//Visa endast ordrar som är finalized
			if($row['finalized']){
				echo "<p>" . $row['orderNr'] . " " . $row['userNr'] . "</p>";
			}
		}
		
		?>
		
	</div>
	
	</div>
		
    </body>
</html>
