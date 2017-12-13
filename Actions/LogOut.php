<?php

	//Avsluta sessionen och töm alla session variabler
	session_start();
	session_unset();
	session_destroy();
	//Skicka användaren till startsidan
	header("Location: ../index.php");
	exit();

?>