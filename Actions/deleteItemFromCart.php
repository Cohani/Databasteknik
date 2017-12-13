<?php

session_start();
include_once 'connection.php';

if(isset($_POST['submit'])){
//Hämta globala variabler från POST
$articleNr = $_POST['submit'];
$orderNr = $_SESSION['currentOrder'];

//SQL för att ta bort artikel
$sql = "DELETE FROM ArticlesInOrder WHERE articleNr = '$articleNr' AND orderNr = '$orderNr'";
//Ställ frågan
$stmt = $conn->prepare($sql);
$stmt->execute();

header("Location: ../index.php");
exit();
} else {
header("Location: ../index.php#Yo");
exit();
}

?>