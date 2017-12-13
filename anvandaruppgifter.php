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
	
	<!-- Formulär för att uppdatera konto -->
	<p> Updatera Kontoinformation </p>
	
	<form action="Actions/UpdateCustomerUser.php" method="POST">
	<input type="text" name="username" placeholder="username">
	<input type="password" name="password" placeholder="password">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
	<!--
	Visa alla skapade konton.
	-->
	
	<br>
		
		<?php
		
		//Hämta användarinformation
		$userNr = $_SESSION['UserId'];
		$sql = "SELECT * FROM User WHERE userNr='$userNr'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
		echo "<p>" . $result['userNr'] . " " . $result['username'] . " " . $result['password'] . "</p>";
		
		?>
	
	
	</div>
		
    </body>
</html>