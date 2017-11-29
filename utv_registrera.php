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
	
	<h1> Registrera, yo! Do it fool, you won't. I dare you I double dare you motherfucker, say "what" one more goddamn time! </h1>
	<br>
	<p> Skapa administratörskonto </p>
	
	<form action="Actions/CreateUser.php" method="POST">
	<input type="text" name="username" placeholder="username">
	<input type="text" name="password" placeholder="password">
	<input type="checkbox" name="admin">
	<button type="submit" name="submit"> skicka </button>
	</form>
	
		<br>
		
		<?php
		
		$sql = "SELECT userNr, username, password FROM User";

		echo "<br>";

		foreach($conn->query($sql) as $row){
			echo $row['userNr'] . " ";
			echo $row['username'] . " ";
			echo $row['password'];
	
			echo "<br>";
		}
		
		?>
	
	<br>
	
	
	</div>
		
    </body>
</html>