<?php

session_start();

$articleNr = $_POST['articleNr'];

if(!isset($_SESSION['articleNr'])){
	$_SESSION['articleId'] = $articleNr;
} else {
	$_SESSION['articleId'] = $articleNr;
}

header("Location: ../utv_artikelsida.php");


?>