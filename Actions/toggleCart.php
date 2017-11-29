<?php
session_start();

if(!isset($_SESSION['showCart'])){
	$_SESSION['showCart'] = true;
} else {
	
	if($_SESSION['showCart']){
		$_SESSION['showCart'] = false;
	} else {
		$_SESSION['showCart'] = true;
	}
}

header("Location: ../utv_index.php");
?>