<?php

//Servernamnet där databsen finns
$servername = "utbweb.its.ltu.se";
//Användarnamn för servern
$username = "robrub-5";
//Serverns lösenord
$password = "***********";

//Upprätta anslutning
try{
	$conn = new PDO("mysql:host=$servername;dbname=robrub5db", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connection established";
}
catch(PDOException $e){
	//Om fel sker vid anslutning:
	echo "Connection failed: " . $e->getMessage();
}
?>
