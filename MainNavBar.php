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
		$userNr = $_SESSION['UserId'];
		$sql = "SELECT * FROM User WHERE userNr='$userNr'";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetch();
	
		//Om användaren är administratör
		if($result['administrator']){
			
			//Ändra huvudmenyn till administratörvy.
			echo "<a href='index.php'>Hem</a>
			<a href='kontohantering.php'>Kontohantering</a>
			<a href='orderhantering.php'>Orderhantering</a>
			<a href='varuhantering.php'>Varuhantering</a>";
		} else{
			//Om användaren är kund
			//Ändra huvudmenyn till kundvy.
			echo "<a href='index.php'>Hem</a>
			<a href='orderhistorik.php'>Orderhistorik</a>
			<a href='anvandaruppgifter.php'>Användaruppgifter</a>";
			
		}
	
		//Logga ut knapp.
		echo "<form action='Actions/LogOut.php' method='POST'>
		<button type='submit' name='submit'> Logga Ut </button>
		</form>";
		
		//Visa Länk till kundvagn
		if(isset($_SESSION['cart'])){
			echo "<a class='regButton' href='Actions/toggleCart.php'>Kundvagn </a>";
		} else {
			echo "<a class='regButton' href='Actions/toggleCart.php'>Kundvagn </a>";
		}
		
		//Skriv ut användarnamnet på menyn
		echo "<p class='userTag'>" . $result['username'] . "</p>";
		
	} else {
		//Om ingen är inloggad
		
		//Ändra huvudmenyn till gästvy.
		echo "<a href='index.php'>Hem</a>";
		
		//Visa inloggiings formulär.
		echo "<form action='Actions/LogIn.php' method='POST'>
		<input type='text' name='username' placeholder='username'>
		<input type='password' name='password' placeholder='password'>
		<button type='submit' name='submit'> Logga in </button>
		</form>";
		
		//Visa länk till registrera sidan.
		echo "<a class='regButton' href='registrera.php'> Registrera </a>";
		
	}
	
	?>
</div>

<!--
Hantering av kundvagnen:
-->
<?php
// Om kundvang finns och användare är inloggad
if(isset($_SESSION['showCart']) && isset($_SESSION['UserId'])){
			// Om kundvagnen ska visas
			if($_SESSION['showCart']){
				
				echo "<div class='cart' id='minCart'>";
				echo "<h3>Kundvagn</h3>";
			
				$orderNr = $_SESSION['currentOrder'];
				
				// SQL för att hämta alla artiklar i kundvagnen
				$sql = "SELECT * FROM Article INNER JOIN ArticlesInOrder ON Article.articleNr = ArticlesInOrder.articleNr WHERE orderNr='$orderNr'";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
				$result = $stmt->fetchAll();
				
				//Skriv ut varje artikel i kundvagnen inom ett formulär med handling för att ta bort varan när den klickas på
				echo "<form action='Actions/deleteItemFromCart.php' method='POST'>";
			
				foreach($result as $row){
					echo "<button type='submit' name='submit' value='" . $row['articleNr'] . "'>" . $row['name'] . " " . $row['quantity'] . "x</button><br>";
				}
			
				echo "</form>";
			}
			
			//Längst ner i kundvangen finns en länk till kassan
			echo "<a href='kassa.php'> Till kassa </a>";
			echo "</div>";
}
?>