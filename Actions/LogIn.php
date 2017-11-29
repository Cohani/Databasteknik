<?php
//Öppna anslutning till databas
include_once 'connection.php';

//Hämta globala variabler från POST
$username = $_POST['username'];
$password = $_POST['password'];

//Den SQL fråga som ska ställas till databasen
$sql = "SELECT * FROM User WHERE username='$username'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetch();

if($result != null){
	if($result['password'] == $password){
		session_start();
		$_SESSION['UserId'] = $result['userNr'];
		$cart = array();
		header("Location: ../utv_index.php");
	} else {
		echo "Wrong password, yo!";
	}
} else{
	echo "Can't find user, yo!";
}


//echo " <br> Administratör: " . $username . " Skapad"

//Skicka användaren tillbaka till startsidan
//header("Location: ../hemsida.php");

?>