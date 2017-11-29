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
	
	<?php
	//Om användaren är inloggad.
	if(isset($_SESSION['UserId'])){
	//Hämta UserId till en lokal variable.
	$uid = $_SESSION['UserId'];
	//Den SQL fråga som ska ställas.
	$sql = "SELECT * FROM User WHERE userNr='$uid'";
	//Förebered frågan till databasen.
	$stmt = $conn->prepare($sql);
	//Ställ frågan till databasen.
	$stmt->execute();
	//Hämta resultaten till lokal variabel. $result kommer nu innehålla all information som finns på raden för den inloggade användaren i databasen.
	$result = $stmt->fetch();
		//Hälsa användaren välkommen vid namn.
		echo "<h2> Välkommen " . $result['username'] . "! </h2>";
		//Om användaren är administratör
		if($result['administrator']){
			//...
		}
	} else {
		//Om användaren inte är inloggad.
		
		echo "<h2> Välkommen du är inte inloggad! </h2>";
		
	}
	
	?>
	
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
	         	
		//SQL fråga för att hämta information från databasen om användare.
		$sql = "SELECT * FROM ArticlesInOrder WHERE orderNr = '$orderId'";
		echo "<br>";

		foreach($conn->query($sql) as $row){
		        echo "<p>orderNr: " . $row['orderNr'] . " ";
	               //echo "<p>userNr: " . $row['userNr'] . "</p> ";
	                echo "articleNr: " . $row['articleNr'] . " ";
	                echo "quantity: " . $row['quantity'] . "</p> ";
	
			echo "<br>";
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
	
	<br>
		
		<?php
		
		//SQL fråga för att hämta information från databasen om användare.
		$sql = "SELECT orderNr, userNr FROM `Order`";

		echo "<br>";

		foreach($conn->query($sql) as $row){
		        echo "orderNr" . " " . $row['orderNr'] . " " . "userNr" . " ";
			echo $row['userNr'];
	
			echo "<br>";
		}
		
		?>
	
	<br>
	</div>
	
	</div>
		
    </body>
</html>
