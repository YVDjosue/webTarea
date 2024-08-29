<?php 
session_start();
require("conexion.php");

$username = $_POST['username'];
$password = $_POST['password'];

$txtQuery = "SELECT * FROM users where username = '$username' and password = '$password' and status = 1";

$query = mysqli_query($conn, $txtQuery);

if(mysqli_num_rows($query)>0){
	$_SESSION['logeado'] = "si";
	header('Location: verTareas.php');
}else{
	header('Location: login.html');
}

?>