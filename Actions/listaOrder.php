<?php
//Öppna anslutning till databas
//include_once 'connection.php';
session_start();

//Globala variabler från POST
$orderNr = $_POST['ordernr'];

if(!isset($_SESSION['orderId'])){
		$_SESSION['orderId'] = $orderNr;
	} else {
	       $_SESSION['orderId'] = $orderNr;
	}

//sql för att hämta info
//$sql = "SELECT * FROM `Order` WHERE orderNr='$ordernr'";
//ställ frågan
//$conn->exec($sql);


//Skicka användaren tillbaka till startsidan
header("Location: ../utv_orderhantering.php");

?>