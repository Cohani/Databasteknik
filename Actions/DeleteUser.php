<?php
//Öppna anslutning till databas
include_once 'connection.php';

if(isset($_POST['submit'])){
//Hämta globala variabler från POST
$userNr = $_POST['user'];

//SQL för att ta bort användare

//Tar bort alla artiklar i ordrar relaterade till användaren
$sql = "DELETE ArticlesInOrder FROM `Order` INNER JOIN ArticlesInOrder ON `Order`.orderNr = ArticlesInOrder.orderNr WHERE `Order`.orderNr = ArticlesInOrder.orderNr AND `Order`.userNr = '$userNr'";
$stmt = $conn->prepare($sql);
$stmt->execute();

//Tar bort alla ordrar relaterade till användaren
$sql = "DELETE FROM `Order` WHERE `Order`.userNr = '$userNr'";
$stmt = $conn->prepare($sql);
$stmt->execute();

//Tar bort alla kommentarer relaterade till användaren
$sql = "DELETE FROM Comment WHERE userNr = '$userNr'";
$stmt = $conn->prepare($sql);
$stmt->execute();

//Tar bort användaren
$sql = "DELETE FROM User WHERE userNr = '$userNr'";
$stmt = $conn->prepare($sql);
$stmt->execute();

//Skicka tillbaka användaren
header("Location: ../kontohantering.php");
exit();

} else {
	header("Location: ../kontohantering.php");
	exit();
}
?>