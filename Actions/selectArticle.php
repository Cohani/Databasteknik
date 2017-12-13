<?php

session_start();

if(isset($_POST['articleNr'])){
//Hämta globala variabler
$articleNr = $_POST['articleNr'];

//Sätt den aktuella artikeln som en session variabel
if(!isset($_SESSION['articleNr'])){
	$_SESSION['articleId'] = $articleNr;
} else {
	$_SESSION['articleId'] = $articleNr;
}

header("Location: ../artikelsida.php");
exit();
} else {

header("Location: ../artikelsida.php#Yo");
exit();

}

?>