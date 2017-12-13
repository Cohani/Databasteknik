<?php
//Öppna anslutning till databas
//include_once 'connection.php';
session_start();

if(isset($_POST['submit'])){
//Globala variabler från POST
$orderNr = $_POST['ordernr'];

//Sätt den aktuella ordern som en session variabel
if(!isset($_SESSION['orderId'])){
	$_SESSION['orderId'] = $orderNr;
} else {
	$_SESSION['orderId'] = $orderNr;
}


//Skicka tillbaka användaren
header("Location: ../orderhantering.php");
exit();
} else {
header("Location: ../orderhantering.php#Yo");
exit();
}

?>