<?php
include('security.php');
include('conexion.php');

$id = $_GET['id'];

$sql = "DELETE FROM tareas WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    header('Location: index.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
