<?php

session_start();
include_once 'connection.php';

if(isset($_POST['articleNr'])){
//Hämta globala variabler
$articleNr = $_POST['articleNr'];
$quantity = $_POST['quantity'];

//Quantity minimum värde är 1
$quantity = $quantity<=0 ? 1 : $quantity;

//Hämta de nuvarande ordern som kundvagn
$orderNr = $_SESSION['currentOrder'];
$sql = "SELECT * FROM ArticlesInOrder WHERE articleNr='$articleNr' AND orderNr='$orderNr'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$order = $stmt->fetch();

//Hämta information om artikeln för att räkna ut subtotal
$sql = "SELECT * FROM Article WHERE articleNr='$articleNr'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$article = $stmt->fetch();
$price = $article['price'];

//Om ordern redan finns
if($order != null){
//Räkna om subtotal och updatera raden
$subTotal = $price * $quantity;
$sql = "UPDATE ArticlesInOrder SET quantity='$quantity', subTotal='$subTotal' WHERE articleNr='$articleNr' AND orderNr='$orderNr'";
$stmt = $conn->prepare($sql);
$stmt->execute();

} else {
//Räkna ut subtotal och skapa en ny rad i ordern med artikeln
$subTotal = $price * $quantity;
$sql = "insert into ArticlesInOrder (orderNr, articleNr, quantity, subTotal) values ( '$orderNr', '$articleNr', '$quantity', '$subTotal')";
$stmt = $conn->prepare($sql);
$stmt->execute();

}
//Skicka tillbaka användaren
header("Location: ../artikelsida.php");
exit();

} else {
header("Location: ../artikelsida.php#Yo");
exit();
}


?>