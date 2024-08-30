<?php 
session_start();
require("conexion.php");

$username = $_POST['username'];
$password = $_POST['password'];

$txtQuery = "SELECT * FROM usuarios where usuario = '$username' and contrasenia = '$password' and estado = 1";

$query = mysqli_query($conn, $txtQuery);

if(mysqli_num_rows($query)>0){
	$_SESSION['logeado'] = "si";
	header('Location: index.php');
}else{
	header('Location: login.html');
}

?>