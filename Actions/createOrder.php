<?php
//Öppna anslutning till databas
include_once 'connection.php';
session_start();

$uid = $_SESSION['UserId'];

$sql = "insert into `order` (userNr) values ('$uid')";
//$stmt = $conn->prepare($sql);
$conn->exec($sql);

$lastid = $conn->lastInsertId();

//List upp artiklar i kundvagn:

			if(isset($_SESSION['cart'])){
				foreach($_SESSION['cart'] as $id=>$value){
					$quantity = implode($value);
					$sql = "insert into ArticlesInOrder (orderNr, articleNr, quantity) values ('$lastid', '$id', '$quantity')";
					$conn->exec($sql);
				}
			}
			
			unset($_SESSION['cart']);


//Skicka användaren tillbaka till startsidan
header("Location: ../utv_index.php");

?>