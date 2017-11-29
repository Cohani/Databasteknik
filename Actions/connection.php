<?php

//Servernamnet där databsen finns
$servername = "utbweb.its.ltu.se";
//Användarnamn för servern
$username = "robrub-5";
//Serverns lösenord
$password = "hejsan%";

//Upprätta anslutning
try{
	$conn = new PDO("mysql:host=$servername;dbname=robrub5db", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo "Connection established";
}
catch(PDOException $e){
	//Echo out om fel sker vid anslutning:
	echo "Connection failed: " . $e->getMessage();
}
?>