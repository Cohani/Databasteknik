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
	
	//Göm kundvagn
	$_SESSION['showCart'] = false;
	
	echo "<h3>Kundvagn</h3>";
	
			$total = 0;
			$product = 0;
			
			//List upp artiklar i kundvagn:
			if(isset($_SESSION['cart'])){
				//$ids = array();
				echo "<form action='Actions/deleteItemFromCart.php' method='POST'>";
				foreach($_SESSION['cart'] as $id=>$value){
					//array_push($ids, $id);
					
					//Use "IN" instead
					$sql = "SELECT * FROM Article WHERE articleNr='$id'";
					$stmt = $conn->prepare($sql);
					$stmt->execute();
					$result = $stmt->fetch();
					//echo "<p>" . $result['name'] . " " . implode($value) . "x</p>";
					$product = implode($value) * $result['price'];
					echo "<button type='submit' name='id' value='" . $id . "'>" . $result['name'] . " " . implode($value) . "x " . $product . "kr</button><br>";
					$total = $total + $product;
				}
				
				echo "</form>";
			}
			echo "Totalt: " . $total . "kr<br>";
			echo "<a href='Actions/createOrder.php'> Beställ </a>";
	
	?>
	
	
	</div>
		
    </body>
</html>