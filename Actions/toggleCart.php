<?php
session_start();

//Om session variablen inte finns
if(!isset($_SESSION['showCart'])){
	//Sätt showCart till true
	$_SESSION['showCart'] = true;
} else {
	//Om kundvagnen visas
	if($_SESSION['showCart']){
		//Dölj kundvagnen
		$_SESSION['showCart'] = false;
	} else {
		//Annars visa kundvagnen
		$_SESSION['showCart'] = true;
	}
}

//Skicka användaren till startsidan
header("Location: ../index.php");
exit();
?>