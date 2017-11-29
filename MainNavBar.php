<?php
//Starta session i början av varje dokument. Detta behövs inte på webbsidor då denna meny alltid inkluderas först i webbsidor.
/*
Session krävs för att lagra globala variablar, t.ex UserId för den inloggade användaren.
Session variables:
$_SESSION[UserId] -- Den inloggade användarens UserId, primärnyckeln för tabellen User i databasen.
*/
session_start();
?>

<!-- Detta är webbplatsens huvudmeny, den bör alltid inkluderas på alla webbplatsens sidor -->
<div class="mainNavBar" id="mainNav">

	<?php
	//Anslut till databasen
	include_once 'Actions/connection.php';
	?>
	
	<?php
	//Om användaren är inloggad
	if(isset($_SESSION['UserId'])){
		
		//Hämta användardata
		$uid = $_SESSION['UserId'];
		$sql = "SELECT * FROM User WHERE userNr='$uid'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
	
		//Om användaren är administratör
		if($result['administrator']){
			
			//Ändra huvudmenyn till administratörvy.
			echo "<a href='utv_index.php'>Hem</a>
			<a href='utv_kontohantering.php'>Kontohantering</a>
			<a href='utv_orderhantering.php'>Orderhantering</a>
			<a href='utv_varuhantering.php'>Varuhantering</a>";
		} else{
			//Om användaren är kund
			//Ändra huvudmenyn till kundvy.
			echo "<a href='utv_index.php'>Hem</a>
			<a href='utv_katalog.php'>Katalog</a>
			<a href='utv_orderhistorik.php'>Orderhistorik</a>
			<a href='utv_anvandaruppgifter.php'>Användaruppgifter</a>";
			
		}
	
		//Logga ut knapp.
		echo "<form action='Actions/LogOut.php' method='POST'>
		<button type='submit' name='submit'> Logga Ut </button>
		</form>";
		
		//Visa användarens namn som en länk till Användaruppgifter.
		if(isset($_SESSION['cart'])){
			echo "<a class='regButton' href='Actions/toggleCart.php'>Kundvagn(" . count($_SESSION['cart']) . ") </a>";
		} else {
			echo "<a class='regButton' href='Actions/toggleCart.php'>Kundvagn(0) </a>";
		}
		
	} else {
		//Om ingen är inloggad
		
		//Ändra huvudmenyn till gästvy.
		echo "<a href='utv_index.php'>Hem</a>
		<a href='utv_katalog.php'>Katalog</a>";
		
		//Visa inloggiings formulär.
		echo "<form action='Actions/LogIn.php' method='POST'>
		<input type='text' name='username' placeholder='username'>
		<input type='text' name='password' placeholder='password'>
		<button type='submit' name='submit'> Logga in </button>
		</form>";
		
		//Visa länk till registrera sidan.
		echo "<a class='regButton' href='utv_registrera.php'> Registrera </a>";
		
	}
	
	?>
	</div>
	
	<?php
	if(isset($_SESSION['showCart']) && isset($_SESSION['UserId'])){
			if($_SESSION['showCart']){
			echo "<div class='cart' id='minCart'>";
	
			echo "<h3>Kundvagn</h3>";
			
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
					echo "<button type='submit' name='id' value='" . $id . "'>" . $result['name'] . " " . implode($value) . "x</button><br>";
					
				}
				
				echo "</form>";
				
				/*
				$ids_arr = str_repeat('?,', count($ids) -1) . '?';
				$sql = "SELECT * FROM Article WHERE articleNr IN ({$ids_arr}) ORDER BY name";
				$stmt = $this->conn->prepare($sql);
				$stmt->execute($ids);
				*/
			}
			echo "<a href='utv_kassa.php'> Till kassa </a>";
	
			echo "</div>";
	}
	}
	?>