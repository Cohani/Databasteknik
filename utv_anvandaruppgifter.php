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
	
	<!-- Formulär för att uppdatera konto -->
	<p> Updatera Kontoinformation </p>
	
	<form action="Actions/UpdateCustomerUser.php" method="POST">
	<input type="text" name="username" placeholder="username">
	<input type="text" name="password" placeholder="password">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	<!--
	Visa alla skapade konton.
	-->
	
	<br>
		
		<?php
		
		$uid = $_SESSION['UserId'];
		$sql = "SELECT * FROM User WHERE userNr='$uid'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		echo "<br>" . $result['userNr'] . " " . $result['username'] . " " . $result['password'] . "<br>";
		
		?>
	
	<br>
	
	
	</div>
		
    </body>
</html>