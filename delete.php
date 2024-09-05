<?php
session_start();
include('security.php');
include('conexion.php');

$id = $_GET['id'];

$sql = "UPDATE tareas SET eliminado=1 WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
