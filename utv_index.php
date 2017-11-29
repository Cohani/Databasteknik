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
		} else {
		}
	} else {
		
		echo "<h2> Välkommen du är inte inloggad! </h2>";
		
	}
	
	?>
	
	
	</div>
		
    </body>
</html>