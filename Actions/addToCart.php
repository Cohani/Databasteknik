<?php

session_start();

$articleNr = $_POST['articleNr'];
$quantity = $_POST['quantity'];

$quantity = $quantity<=0 ? 1 : $quantity;
$cart = array($quantity);

if(!isset($_SESSION['cart'])){
	$_SESSION['cart'] = array();
}

if(array_key_exists($articleNr, $_SESSION['cart'])){
	if($_SESSION['cart'][$articleNr] != $quantity){
		$_SESSION['cart'][$articleNr] = $cart;
	}
} else {
	$_SESSION['cart'][$articleNr] = $cart;
}

header("Location: ../utv_artikelsida.php");


?>