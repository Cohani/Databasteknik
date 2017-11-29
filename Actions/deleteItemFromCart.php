<?php

session_start();

if(isset($_POST['id'])){
	$id = $_POST['id'];

	unset($_SESSION['cart'][$id]);

	header("Location: ../utv_index.php");
}


?>